<?php

class AppUserTable extends Doctrine_Table
{
  public static function getInstance()
  {
    return Doctrine_Core::getTable('AppUser');
  }
  
  /**
	 * Check email repeated in DB
	 *
	 * @param string $email
	 * @param integer $user_id
	 * @return boolean
	 */
	public function emailIsRepeated($email, $user_id)
	{
		$user_condition = $user_id ? ' AND id != '.$user_id : '';

		$q = Doctrine_Query::create()->from('AppUser')->where("email = '$email'".$user_condition);
		$d = $q->fetchOne();

		return $d ? true : false;
	}
	
	/**
	 * Get pager for list of users
	 *
	 * @param integer $page
	 * @param integer $per_page
	 * @param string $filter
	 * @param string $order
	 * @return doctrine pager
	 */
  public function getPager($page, $per_page, $filter, $order)
	{
		$oPager = new sfDoctrinePager('AppUser', $per_page);
		$oPager->getQuery()
					 ->from('AppUser')
					 ->where($filter)
					 ->orderBy($order);
		$oPager->setPage($page);
		$oPager->init();

		return $oPager;
	}
	
	/**
   * Upload photo process
   *
   * @param array $file
   * @param mixed $recorded
   * @param boolean $reset
   */
  public function uploadPhoto($file, $recorded, $reset = false)
  {
  	$destination = ServiceFileHandler::getUploadFolder('user');

  	if ($file['size'] > 0) {
	  	$f_extension = strtolower(strrchr($file['name'], '.'));
			$upload_file = date('Y').'/'.uniqid('').$f_extension;

			if (move_uploaded_file($file['tmp_name'], $destination.$upload_file)) {
				if ($recorded->getPhoto()) {
					@unlink($destination.$recorded->getPhoto());
					@unlink($destination.ServiceFileHandler::getThumbImage($recorded->getPhoto()));
				}
				@chmod($destination.$upload_file, 0777);
				$recorded->setPhoto($upload_file);

				## Create thumbnail
				$oResize = new ResizeImage();
				$aThumbs = array(ServiceFileHandler::getThumbImage($upload_file) => array('w'=>20, 'h'=>20), $upload_file => array('w'=>150, 'h'=>150));
				$oResize->setMultiple($upload_file, $aThumbs, $destination, 0, 0, $f_extension, array('metodo' => 'full'));
			}
  	} elseif ($reset && $recorded->getPhoto()) {
  		@unlink($destination.$recorded->getPhoto());
  		@unlink($destination.ServiceFileHandler::getThumbImage($recorded->getPhoto()));

  		$recorded->setPhoto(NULL);
  	}
  	$recorded->save();
  }
  
  /**
   * Get info by email
   *
   * @param string $email
   * @return mixed
   */
  public function getUserInfoByEmail($email)
  {
  	$q = Doctrine_Query::create()->from('AppUser u')->leftJoin('u.Company c')->where("u.email = '$email'");

  	if ($q->count() > 0) {
  		return $q->fetchOne();
  	}
  	return NULL;
  }

} // end class