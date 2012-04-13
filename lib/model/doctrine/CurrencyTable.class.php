<?php

class CurrencyTable extends Doctrine_Table
{
  public static function getInstance() { return Doctrine_Core::getTable('Currency'); }
  
  /**
	 * Get array of all operations
	 *
	 * @return array
	 */
	public function getAllForSelect()
	{
		$arr_options = array();

		$q = Doctrine_Query::create()->from('Currency')->orderBy('name ASC');
		$d = $q->fetchArray();

		foreach ($d as $value) {
			$arr_options[$value['id']] = '['.$value['symbol'].']'.' '.$value['iso_code'];
		}
		return $arr_options;
	}

} // end class