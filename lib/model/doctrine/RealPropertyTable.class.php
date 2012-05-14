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
   * @param string $culture
   * @return doctrine pager
   */
  public function getPager($page, $per_page, $filter, $order, $culture = 'es')
  {
    $oPager = new sfDoctrinePager('RealProperty', $per_page);
    $oPager->getQuery()
           ->from('RealProperty p')
           ->leftJoin('p.Translation t WITH t.lang = ?', $culture)
           ->leftJoin('p.Neighborhood n')
           ->leftJoin('p.PropertyType pt')
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
   * @param array $data_currency
   * @return doctrine pager
   */
  public function searchResults($page, $per_page, $filter, $order, $data_currency = array())
  {
    if (array_sum($data_currency) > 0) {
      $array_property_operation = OperationRealProperty::getArrayPropertyByOperation($data_currency);
    }
    $oPager = new sfDoctrinePager('RealProperty', $per_page);
    $oPager->getQuery()
           ->from('RealProperty p')
           ->where($filter)
           ->orderBy('p.updated DESC');

    if (!empty($array_property_operation)) {
    	$oPager->getQuery()->andWhereIn('p.id', $array_property_operation);
    }
    $oPager->setPage($page);
    $oPager->init();

    return $oPager;
  }

} // end class