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

} // end class