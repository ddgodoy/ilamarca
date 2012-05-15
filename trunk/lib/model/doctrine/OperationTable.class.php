<?php

class OperationTable extends Doctrine_Table
{
  public static function getInstance() { return Doctrine_Core::getTable('Operation'); }
  
  /**
	 * Get array of all operations
	 *
	 * @param boolean $add_empty
	 * @param string $empty_text
	 * @return array
	 */
	public function getAllForSelect($add_empty = false, $empty_text = 'Select')
	{
		$arr_options = array();
		$sf_instance = sfContext::getInstance();
		
		if ($add_empty) {
			$arr_options['0'] = '-- '.$sf_instance->getI18N()->__($empty_text).' --';
		}
		$q = Doctrine_Query::create()->select('id, name')->from('Operation')->orderBy('name ASC');
		$d = $q->fetchArray();

		foreach ($d as $value) {
			$arr_options[$value['id']] = $value['name'];
		}
		return $arr_options;
	}
	
	/**
	 * Upd operations for this property
	 *
	 * @param integer $property_id
	 * @param array $operations
	 * @param array $currencies
	 * @param array $prices
	 */
	public function updOperationsForThisProperty($property_id, $operations, $currencies, $prices)
	{
    OperationRealPropertyTable::getInstance()->deleteOperationsByProperty($property_id);

    foreach ($operations as $v)
    {
      $operation = new OperationRealProperty();

      $operation->setOperationId   ($v);
      $operation->setCurrencyId    ($currencies[$v]['id']);
      $operation->setPrice         ($prices[$v]['number']);
      $operation->setRealPropertyId($property_id);
      $operation->save();
    }
	}

} // end class