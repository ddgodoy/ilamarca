<?php

class NeighborhoodTable extends Doctrine_Table
{
  public static function getInstance() { return Doctrine_Core::getTable('Neighborhood'); }
  
  /**
	 * Get pager for list of users
	 *
	 * @param integer $page
	 * @param integer $per_page
	 * @param string $filter
	 * @param string $order
	 * @return doctrine pager
	 */
  public function getPager($page, $per_page, $filter, $order)
	{		
		$oPager = new sfDoctrinePager('Neighborhood', $per_page);
		$oPager->getQuery()
					 ->from('Neighborhood n')
					 ->leftJoin('n.City c')
					 ->leftJoin('c.GeoZone g')
					 ->where($filter)
					 ->orderBy($order);
		$oPager->setPage($page);
		$oPager->init();

		return $oPager;
	}
	
	/**
	 * Get neighborhoods by city
	 *
	 * @param integer $city
	 * @return array
	 */
	public function getByCityId($city)
	{
		$sf_instance = sfContext::getInstance();
		$arr_options = array('-- '.$sf_instance->getI18N()->__('Select').' --');
		
		$q = Doctrine_Query::create()->select('id, name')->from('Neighborhood')->where("city_id = $city")->orderBy('name ASC');
		$d = $q->fetchArray();

		foreach ($d as $value) {
			$arr_options[$value['id']] = $value['name'];
		}
		return $arr_options;
	}

} // end class