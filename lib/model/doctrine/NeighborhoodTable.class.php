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

} // end class