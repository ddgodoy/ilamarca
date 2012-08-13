<?php

class SearchContactTable extends Doctrine_Table
{ 
  public static function getInstance() { return Doctrine_Core::getTable('SearchContact'); }
  
  /**
	 * Get pager for list of vendor searchs
	 *
	 * @param integer $page
	 * @param integer $per_page
	 * @param string $filter
	 * @param string $order
	 * @return doctrine pager
	 */
  public function getSearchPager($page, $per_page, $filter, $order)
	{
		$oPager = new sfDoctrinePager('SearchProfile', $per_page);
		$oPager->getQuery()
					 ->from('SearchProfile sp')
					 ->where($filter)
					 ->orderBy($order);
		$oPager->setPage($page);
		$oPager->init();

		return $oPager;
	}
  
} // end class