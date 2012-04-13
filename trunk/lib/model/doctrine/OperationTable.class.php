<?php

class OperationTable extends Doctrine_Table
{
  public static function getInstance() { return Doctrine_Core::getTable('Operation'); }
  
  /**
	 * Get array of all operations
	 *
	 * @return array
	 */
	public function getAllForSelect()
	{
		$arr_options = array();

		$q = Doctrine_Query::create()->select('id, name')->from('Operation')->orderBy('name ASC');
		$d = $q->fetchArray();

		foreach ($d as $value) {
			$arr_options[$value['id']] = $value['name'];
		}
		return $arr_options;
	}

} // end class