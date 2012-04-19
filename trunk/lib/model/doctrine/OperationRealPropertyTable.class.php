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
	//
  public function deleteOperationsByProperty($property_id)
  {
    $q = $this->createQuery('orp')->delete()->where('real_property_id = ?', $property_id);
    $q->execute();
  }

} // end class