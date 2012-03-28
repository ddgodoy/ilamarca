<?php

class UserRoleTable extends Doctrine_Table
{
	public static function getInstance()
  {
    return Doctrine_Core::getTable('UserRole');
  }

  /**
	 * Get array of all roles for select tag
	 *
	 * @param boolean $add_empty
	 * @return array $arr_options
	 */
	public function getAllForSelect($add_empty = false)
	{
		$sql_exclude = 'id > 0';
		$arr_options = array();
		$sf_instance = sfContext::getInstance();

		if ($add_empty) {
			$arr_options['0'] = '-- '.$sf_instance->getI18N()->__('Select').' --';
		}
		## exclude super_admin role from results
		if ($sf_instance->getUser()->getAttribute('user_role') != 'super_admin') {
			$sql_exclude .= " AND code != 'super_admin'";
		}
		##
		$q = Doctrine_Query::create()->select('id, name')->from('UserRole')->where($sql_exclude)->orderBy('id ASC');
		$d = $q->fetchArray();

		foreach ($d as $value) {
			$arr_options[$value['id']] = $value['name'];
		}
		return $arr_options;
	}

} // end class