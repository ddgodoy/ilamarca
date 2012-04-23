<?php

class OperationRealPropertyTable extends Doctrine_Table
{
  public static function getInstance() { return Doctrine_Core::getTable('OperationRealProperty'); }
  
    /**
    * Get array of operations by property
    *
    * @return array
    */
    public function getOperationsByPropertyId($property_id)
    {
    $q = $this->createQuery('orp')
          ->where('real_property_id = ?', $property_id)
          ->orderBy('operation_id');

    return $q->execute();
    }

    /**
    * Get operations by property and culture
    * @param int $property
    * @param string $culture
    * @return array
    */
    public function getOperationsByPropertyIdAndCulture($property_id, $culture)
    {
        $q = $this->createQuery('orp')
              ->leftJoin('orp.Currency c')
              ->where('real_property_id = ?', $property_id)
              ->andWhere('c.culture = ?', $culture)
              ->orWhere('c.culture = ?', 'es')
              ->orderBy('operation_id');

        return $q->fetchOne();
    }

    //
    public function deleteOperationsByProperty($property_id)
    {
    $q = $this->createQuery('orp')->delete()->where('real_property_id = ?', $property_id);
    $q->execute();
    }

    /**
     * get id property by currency
     * @param int $currency
     * @param int $p_desde
     * @param int $p_hasta 
     * @return sql query
     */
    public function getIdPropertyByCurrency($currency = 0, $p_desde = '', $p_hasta = '')
    {
        $q = $this->createQuery('orp');
             //->select('orp.real_property_id as property');
            if($currency!= 0)
            {
                 $q->where('orp.currency_id  = ?', $currency);
            }
            if($p_desde != '')
            {
                $q->andWhere('orp.price >= ?', $p_desde);
            }
            if($p_hasta != '')
            {
                $q->andWhere('orp.price <= ?', $p_hasta);
            }

        
        return $q->execute();
    }
} // end class