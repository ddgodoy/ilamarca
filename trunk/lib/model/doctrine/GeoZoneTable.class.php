<?php

class GeoZoneTable extends Doctrine_Table
{
  public static function getInstance() { return Doctrine_Core::getTable('GeoZone'); }
  
  /**
	 * Get pager for list of geo zones
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
	 * @param string $empty_text
	 * @return array
	 */
	public function getAllForSelect($add_empty = false, $empty_text = 'Select', $country = '')
	{
		$arr_options = array();
		$sf_instance = sfContext::getInstance();

		if ($add_empty) {
			$arr_options['0'] = '-- '.$sf_instance->getI18N()->__($empty_text).' --';
		}
		$q = Doctrine_Query::create()
             ->select('id, name')
             ->from('GeoZone')
             ->orderBy('id');

        if($country)
        {
            $q->andWhere('country_id = ?', $country);
        }
        
		$d = $q->fetchArray();

		foreach ($d as $value) {
			$arr_options[$value['id']] = $value['name'];
		}
		return $arr_options;
	}

} // end class