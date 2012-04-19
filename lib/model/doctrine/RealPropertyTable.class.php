<?php

class RealPropertyTable extends Doctrine_Table
{  
  public static function getInstance() { return Doctrine_Core::getTable('RealProperty'); }
  
  /**
	 * Get pager for list of properties
	 *
	 * @param integer $page
	 * @param integer $per_page
	 * @param string $filter
	 * @param string $order
	 * @return doctrine pager
	 */
  public function getPager($page, $per_page, $filter, $order)
	{		
		$oPager = new sfDoctrinePager('RealProperty', $per_page);
		$oPager->getQuery()
					 ->from('RealProperty p')
					 ->leftJoin('p.Neighborhood n')
					 ->where($filter)
					 ->orderBy($order);
		$oPager->setPage($page);
		$oPager->init();

		return $oPager;
	}
	
	/**
	 * Get results for properties search
	 *
	 * @param integer $page
	 * @param integer $per_page
	 * @param string $filter
	 * @param string $order
	 * @return doctrine pager
	 */
  public function searchResults($page, $per_page, $filter, $order)
	{		
		$oPager = new sfDoctrinePager('RealProperty', $per_page);
		$oPager->getQuery()
					 ->from('RealProperty p')
					 ->where($filter)
					 ->orderBy('p.updated DESC');
		$oPager->setPage($page);
		$oPager->init();

		return $oPager;
	}

} // end class