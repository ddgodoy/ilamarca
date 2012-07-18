<?php

class SearchProfileTable extends Doctrine_Table
{  
  public static function getInstance() { return Doctrine_Core::getTable('SearchProfile'); }
  
  /**
   * Get searchs made by user
   *
   * @param integer $user_id
   * @return object
   */
  public function getSearchsForThisUser($user_id)
  {
  	$q = Doctrine_Query::create()
  	     ->from('SearchProfile sp')
  	     ->leftJoin('sp.PropertyType pt')
  	     ->leftJoin('sp.Operation op')
  	     ->leftJoin('sp.City c')
  	     ->leftJoin('sp.Neighborhood n')
  	     ->where("sp.app_user_id = $user_id")
  	     ->orderBy('sp.created_at DESC');

		return $q->execute();
  }
  
  /**
   * Get searchs for admin user
   *
   * @param integer $user_id
   * @param string $filter
   * @return object
   */
  public function getSearchsForAdminUser($user_id, $filter)
  {
  	$f = "sm.vendor_id = $user_id";

  	if (!empty($filter)) {
  		$f .= " AND sp.name LIKE '%$filter%'";
  	}
  	$q = Doctrine_Query::create()
  	     ->from('SearchMatch sm')
  	     ->leftJoin('sm.SearchProfile sp')
  	     ->leftJoin('sp.AppUser u')
  	     ->leftJoin('sp.PropertyType pt')
  	     ->leftJoin('sp.Operation op')
  	     ->leftJoin('sp.City c')
  	     ->leftJoin('sp.Neighborhood n')
  	     ->where($f)
  	     ->orderBy('sp.created_at DESC');

		return $q->execute();
  }
  
  /**
   * Check if search is already saved
   *
   * @param object $u
   * @return boolean
   */
  public function checkSearchAlreadySaved($u)
  {
  	$r = false;

  	if ($u->isAuthenticated()) {
  		$f = 'app_user_id = '.$u->getAttribute('user_id');

  		$_bedroom       = $u->getAttribute('sch_bedroom');
  		$_property_type = $u->getAttribute('sch_property_type');
  		$_operation     = $u->getAttribute('sch_operation');
  		$_geo_zone      = $u->getAttribute('sch_geo_zone');
  		$_city          = $u->getAttribute('sch_city');
  		$_neighborhood  = $u->getAttribute('sch_neighborhood');
  		$_currency      = $u->getAttribute('sch_currency');
  		$_p_from        = $u->getAttribute('sch_p_from');
  		$_p_to          = $u->getAttribute('sch_p_to');

  		if (empty($_bedroom))       { $f .= ' AND bedroom_id IS NULL'; }       else { $f .= " AND bedroom_id = $_bedroom"; }
  		if (empty($_property_type)) { $f .= ' AND property_type_id IS NULL'; } else { $f .= " AND property_type_id = $_property_type"; }
  		if (empty($_operation))     { $f .= ' AND operation_id IS NULL'; }     else { $f .= " AND operation_id = $_operation"; }
  		if (empty($_geo_zone))      { $f .= ' AND geo_zone_id IS NULL'; }      else { $f .= " AND geo_zone_id = $_geo_zone"; }
  		if (empty($_city))          { $f .= ' AND city_id IS NULL'; }          else { $f .= " AND city_id = $_city"; }
  		if (empty($_neighborhood))  { $f .= ' AND neighborhood_id IS NULL'; }  else { $f .= " AND neighborhood_id = $_neighborhood"; }
  		if (empty($_currency))      { $f .= ' AND currency_id IS NULL'; }      else { $f .= " AND currency_id = $_currency"; }
  		if (empty($_p_from))        { $f .= ' AND min_price = 0'; }            else { $f .= " AND min_price = $_p_from"; }
  		if (empty($_p_to))          { $f .= ' AND max_price = 0'; }            else { $f .= " AND max_price = $_p_to"; }

  		$q = Doctrine_Query::create()->from('SearchProfile')->where($f)->fetchOne();

  		if (!$q) { $r = true; }
  	}
  	return $r;
  }

} // end class