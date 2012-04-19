<?php

class CityTable extends Doctrine_Table
{
  public static function getInstance() { return Doctrine_Core::getTable('City'); }
  
  /**
	 * Get pager for list of cities
	 *
	 * @param integer $page
	 * @param integer $per_page
	 * @param string $filter
	 * @param string $order
	 * @return doctrine pager
	 */
  public function getPager($page, $per_page, $filter, $order)
	{		
		$oPager = new sfDoctrinePager('City', $per_page);
		$oPager->getQuery()
					 ->from('City c')
					 ->leftJoin('c.GeoZone g')
					 ->where($filter)
					 ->orderBy($order);
		$oPager->setPage($page);
		$oPager->init();

		return $oPager;
	}
	
	/**
	 * Get cities by geo zone
	 *
	 * @param integer $geo_zone
	 * @param string $empty_text
	 * @return array
	 */
	public function getByGeoZoneId($geo_zone, $empty_text = 'Select')
	{
		$sf_instance = sfContext::getInstance();
		$arr_options = array('-- '.$sf_instance->getI18N()->__($empty_text).' --');

		$q = Doctrine_Query::create()->select('id, name')->from('City')->where("geo_zone_id = $geo_zone")->orderBy('name ASC');
		$d = $q->fetchArray();

		foreach ($d as $value) {
			$arr_options[$value['id']] = $value['name'];
		}
		return $arr_options;
	}

} // end class