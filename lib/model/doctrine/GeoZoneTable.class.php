<?php

class GeoZoneTable extends Doctrine_Table
{
  public static function getInstance() { return Doctrine_Core::getTable('GeoZone'); }
  
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
		$oPager = new sfDoctrinePager('GeoZone', $per_page);
		$oPager->getQuery()
					 ->from('GeoZone')
					 ->where($filter)
					 ->orderBy($order);
		$oPager->setPage($page);
		$oPager->init();

		return $oPager;
	}

	/**
	 * Get array of all geo_zones for select tag
	 *
	 * @param boolean $add_empty
	 * @return array
	 */
	public function getAllForSelect($add_empty = false)
	{
		$arr_options = array();
		$sf_instance = sfContext::getInstance();

		if ($add_empty) {
			$arr_options['0'] = '-- '.$sf_instance->getI18N()->__('Select').' --';
		}
		$q = Doctrine_Query::create()->select('id, name')->from('GeoZone')->orderBy('name ASC');
		$d = $q->fetchArray();

		foreach ($d as $value) {
			$arr_options[$value['id']] = $value['name'];
		}
		return $arr_options;
	}

} // end class