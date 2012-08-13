<?php

class SearchMatchTable extends Doctrine_Table
{
  public static function getInstance() { return Doctrine_Core::getTable('SearchMatch'); }
  
  /**
   * Register by search conditions
   *
   * @param string $filter
   * @param integer $search_profile_id
   * @param string $host
   */
  public function recBySearchConditions($filter, $search_profile_id, $host = '')
  {
  	$q = Doctrine_Query::create()->from('RealProperty p')->leftJoin('p.AppUser au')->where($filter);

		if ($q->count() > 0) {
			$u = array();
  		$b = array();
			$d = $q->execute();

			foreach ($d as $value) {
				$user_id = $value->getAppUserId();
				$zone_id = $value->getNeighborhoodId();

				$u[$user_id] = $value->AppUser->getEmail().'?'.$value->AppUser->getName().' '.$value->AppUser->getLastName();
				$b[$zone_id] = $zone_id;
			}
			// get vendors by zone
			if (count($b) > 0) {
				$st_barrios = ''; foreach ($b as $barrio) { $st_barrios .= $barrio.','; }
				$qr_vendors = Doctrine_Query::create()
										 ->from('VendorZone vz')
										 ->leftJoin('vz.AppUser au')
										 ->where('vz.neighborhood_id IN ('.substr($st_barrios, 0, -1).')');

				if ($qr_vendors->count() > 0) {
					$d_vendors = $qr_vendors->execute();

					foreach ($d_vendors as $vendor) {
						$v = $vendor->getAppUserId();
						$u[$v] = $vendor->AppUser->getEmail().'?'.$vendor->AppUser->getName().' '.$vendor->AppUser->getLastName();
					}
				}
			}
			// final rec in DB
			foreach ($u as $u_id => $u_info) {
				$oMatch = new SearchMatch();
				$oMatch->setVendorId($u_id);
				$oMatch->setSearchProfileId($search_profile_id);
				$oMatch->save();
			}
			// send automatic message to vendors
			myUser::notifyVendorsOnSearchMatch($u, $host);
		}
  }
  
  /**
   * Get properties in query for admin user
   *
   * @param string $query
   * @param integer $vendor
   * @return object
   */
  public function getPropertiesInProfile($query, $vendor)
  {
  	$sz = '';
  	$qz = Doctrine_Query::create()->from('VendorZone')->where("app_user_id = $vendor");
  	
  	if ($qz->count() > 0) {
  		$dz = $qz->execute();

  		foreach ($dz as $v_z) { $sz .= $v_z->getNeighborhoodId().','; }
  	}
  	$sz = substr($sz, 0, -1);

  	if (!empty($sz)) {
  		$sz = "OR p.neighborhood_id IN ($sz)";
  	}
  	$filter = "$query AND (p.app_user_id = $vendor $sz)";

  	$q = Doctrine_Query::create()
  			 ->from('RealProperty p')
  			 ->leftJoin('p.Neighborhood n')
  			 ->leftJoin('p.PropertyType pt')
  			 ->where($filter)
  			 ->orderBy('p.updated DESC')
  			 ->limit(50);

		return $q->count() > 0 ? $q->execute() : NULL;
  }
  
  /**
   * Match property and customers search
   *
   * @param integer $real_property_id
   * @return array
   */
  public function matchThisPropertyAndCustomersSearch($real_property_id)
  {
  	$a = array();
  	$o = Doctrine_Query::create()->from('OperationRealProperty')->where("real_property_id = $real_property_id")->execute();

  	$ope_filter = 'sp.operation_id IS NULL';
  	$cur_filter = 'sp.currency_id IS NULL';
  	$min_filter = 'sp.min_price = 0';
  	$max_filter = 'sp.max_price = 0';

  	foreach ($o as $value) {
  		$ope_filter .= ' OR sp.operation_id = '.$value->getOperationId();
  		$cur_filter .= ' OR sp.currency_id = '.$value->getCurrencyId();
  		$min_filter .= ' OR sp.min_price <= '.$value->getPrice();
  		$max_filter .= ' OR sp.max_price >= '.$value->getPrice();
  	}
  	$rProperty = RealPropertyTable::getInstance()->find($real_property_id);
  	
  	if ($rProperty) {
  		$vendor_id   = $rProperty->getAppUserId();
  		$bedroom_id  = $rProperty->getBedroomId();
  		$pro_type_id = $rProperty->getPropertyTypeId();
  		$geo_zone_id = $rProperty->getGeoZoneId();
  		$city_id     = $rProperty->getCityId();
  		$neighbor_id = $rProperty->getNeighborhoodId();
  		
  		$f = "(sp.bedroom_id IS NULL OR sp.bedroom_id = $bedroom_id) AND ".
  				 "(sp.property_type_id IS NULL OR sp.property_type_id = $pro_type_id) AND ".
  				 "(sp.geo_zone_id IS NULL OR sp.geo_zone_id = $geo_zone_id) AND ".
  				 "(sp.city_id IS NULL OR sp.city_id = $city_id) AND ".
  				 "(sp.neighborhood_id IS NULL OR sp.neighborhood_id = $neighbor_id) AND ".
  				 "($ope_filter) AND ".
  				 "($cur_filter) AND ".
  				 "($min_filter) AND ".
  				 "($max_filter)";

  		$q = Doctrine_Query::create()->from('SearchProfile sp')->leftJoin('sp.AppUser u')->where($f);
  		
  		if ($q->count() > 0) {
  			$d = $q->execute();
  			
  			foreach ($d as $res) {
  				// upd search_match
  				self::updSearchMatchOnRealPropertyReg($res->getId(), $vendor_id, $neighbor_id);

  				// customer emails
  				$a[$res->AppUser->getEmail()] = $res->AppUser->getName().' '.$res->AppUser->getLastName();
  			}
  		}
  	}
  	return $a;
  }
  
  /**
   * Update search match table on real_property registration
   *
   * @param integer $search_profile_id
   * @param integer $vendor_id
   * @param integer $neighborhood_id
   */
  public function updSearchMatchOnRealPropertyReg($search_profile_id, $vendor_id, $neighborhood_id)
  {
  	$a[$vendor_id] = $vendor_id;
  	$v = Doctrine_Query::create()->from('VendorZone')->where("neighborhood_id = $neighborhood_id")->execute();
  	
  	foreach ($v as $value) {
  		$a[$value->getAppUserId()] = $value->getAppUserId();
  	}
  	foreach ($a as $vendor) {
  		$check = Doctrine_Query::create()->from('SearchMatch')->where("search_profile_id = $search_profile_id AND vendor_id = $vendor");
  		
  		if ($check->count() == 0) {
  			$obj = new SearchMatch();
  			$obj->setSearchProfileId($search_profile_id);
  			$obj->setVendorId($vendor);
  			$obj->save();
  		}
  	}
  }
  
} // end class