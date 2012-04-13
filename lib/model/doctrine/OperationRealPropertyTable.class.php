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
		$a = array('operations'=>array(), 'currencies'=>array(), 'prices'=>array());

		$q = Doctrine_Query::create()->from('OperationRealProperty')->where("real_property_id = $property_id")->orderBy('operation_id');
		$d = $q->fetchArray();

		foreach ($d as $value) {
			//$arr_options[$value['id']] = $value['name'];
		}
		return $a;
	}

} // end class