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
			// send automatic message to vendor
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
  
} // end class