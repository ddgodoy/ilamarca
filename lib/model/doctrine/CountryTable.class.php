<?php

class CountryTable extends Doctrine_Table
{  
  public static function getInstance() { return Doctrine_Core::getTable('Country'); }
    
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
		$oPager = new sfDoctrinePager('Country', $per_page);
		$oPager->getQuery()
					 ->from('Country')
					 ->where($filter)
					 ->orderBy($order);
		$oPager->setPage($page);
		$oPager->init();

		return $oPager;
	}

} // end class