<?php

class PropertyTypeTable extends Doctrine_Table
{  
  public static function getInstance() { return Doctrine_Core::getTable('PropertyType'); }

  /**
	 * Get array of all property types for select tag
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
		$q = Doctrine_Query::create()->select('id, name')->from('PropertyType')->orderBy('id');
		$d = $q->fetchArray();

		foreach ($d as $value) {
			$arr_options[$value['id']] = $value['name'];
		}
		return $arr_options;
	}

} // end class