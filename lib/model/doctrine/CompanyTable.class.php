<?php

class CompanyTable extends Doctrine_Table
{	
	public static function getInstance()
  {
    return Doctrine_Core::getTable('Company');
  }

	/**
	 * Get pager for list of companies
	 *
	 * @param integer $page
	 * @param integer $per_page
	 * @param string $filter
	 * @param string $order
	 * @return doctrine pager
	 */
  public function getPager($page, $per_page, $filter, $order)
	{
		$oPager = new sfDoctrinePager('Company', $per_page);
		$oPager->getQuery()
					 ->from('Company')
					 ->where($filter)
					 ->orderBy($order);
		$oPager->setPage($page);
		$oPager->init();

		return $oPager;
	}

	/**
	 * Get array of all companies for select tag
	 *
	 * @param boolean $add_empty
	 * @return array $arr_options
	 */
	public function getAllForSelect($add_empty = false)
	{
		$arr_options = array();

		if ($add_empty) {
			$arr_options['0'] = '-- '.sfContext::getInstance()->getI18N()->__('Select').' --';
		}
		$q = Doctrine_Query::create()->select('id, name')->from('Company')->orderBy('name ASC');
		$d = $q->fetchArray();

		foreach ($d as $value) {
			$arr_options[$value['id']] = $value['name'];
		}
		return $arr_options;
	}

	/**
   * Upload logo process
   *
   * @param array $file
   * @param mixed $recorded
   * @param boolean $reset
   */
  public function uploadLogo($file, $recorded, $reset = false)
  {
  	$destination = ServiceFileHandler::getUploadFolder('company');

  	if ($file['size'] > 0) {
	  	$f_extension = strtolower(strrchr($file['name'], '.'));
			$upload_file = date('Y').'/'.uniqid('').$f_extension;

			if (move_uploaded_file($file['tmp_name'], $destination.$upload_file)) {
				if ($recorded->getLogo()) {
					@unlink($destination.$recorded->getLogo());
				}
				@chmod($destination.$upload_file, 0777);
				$recorded->setLogo($upload_file);

				## Resize image
				$oResize = new ResizeImage();
				$oResize->setSimple($upload_file, $upload_file, $destination, 160, 57, 0, 0, $f_extension, array('metodo' => 'full'));
			}
  	} elseif ($reset && $recorded->getLogo()) {
  		@unlink($destination.$recorded->getLogo());
  		$recorded->setLogo(NULL);
  	}
  	$recorded->save();
  }

} // end class