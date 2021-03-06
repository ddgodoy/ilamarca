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
           ->leftJoin('p.AppUser aus')
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
   * @param array $data_currency
   * @param string $rq_method
   * @param array $params
   * 
   * @return doctrine pager
   */
  public function searchResults($page, $per_page, $filter, $data_currency = array(), $rq_method, $params)
  {
    if (array_sum($data_currency) > 0)
    {
      $array_property_operation = OperationRealProperty::getArrayPropertyByOperation($data_currency);
    }
    $oPager = new sfDoctrinePager('RealProperty', $per_page);
    $oPager->getQuery()
           ->from('RealProperty p')
           ->where($filter)
           ->orderBy('p.updated DESC');

    if (!empty($array_property_operation))
    {
    	$add_to_filter = '';
    	$oPager->getQuery()->andWhereIn('p.id', $array_property_operation);
    	
    	foreach ($array_property_operation as $v_pro_ope) {
    		$add_to_filter .= $v_pro_ope.',';
    	}
    	$filter .= ' AND p.id IN ('.substr($add_to_filter, 0, -1).')';

        $oPager->setPage($page);
        $oPager->init();
    }
    elseif(array_sum($data_currency) > 0)
    {
      $oPager->getQuery()->andWhere('p.id=?',0);
    }
    $oPager->setPage($page);
    $oPager->init();
    //
    myUser::recSearchInSession($rq_method, $params, $filter);
    //
    return $oPager;
  }
  
  /**
   * Get db properties for newsletter
   *
   * @param string $filter
   * @return object
   */
 	public function getDbPropertyListaForNs($filter)
  {
  	$q = Doctrine_Query::create()
  			 ->from('RealProperty p')
         ->leftJoin('p.Translation t WITH t.lang = ?', 'es')
         ->leftJoin('p.Neighborhood n')
         ->leftJoin('p.AppUser aus')
         ->leftJoin('p.PropertyType pt')
         ->where('p.id IN ('.$filter.')')
         ->orderBy('p.id');

  	return $q->count() > 0 ? $q->execute() : NULL;
  }

} // end class