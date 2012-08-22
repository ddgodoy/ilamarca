<?php

class VendorZoneTable extends Doctrine_Table
{    
  public static function getInstance() { return Doctrine_Core::getTable('VendorZone'); }
  
  /**
   * Ger zone vendor for this property
   *
   * @param integer $neighborhood_id
   * @param integer $owner_id
   * @return array
   */
  public function getZoneVendorsForContact($neighborhood_id, $owner_id)
  {
  	$a = array();
  	$q = Doctrine_Query::create()
  			 ->from('VendorZone vz')
  			 ->leftJoin('vz.AppUser au')
  			 ->where("vz.neighborhood_id = $neighborhood_id AND vz.app_user_id != $owner_id");
  	
  	if ($q->count() > 0) {
  		$d = $q->execute();
  		
  		foreach ($d as $value) {
  			$a[$value->AppUser->getEmail()] = $value->AppUser->getName().' '.$value->AppUser->getLastName();
  		}
  	}
  	return $a;
  }
  
} // end class