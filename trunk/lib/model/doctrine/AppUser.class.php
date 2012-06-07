<?php

/**
 * AppUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sf_icox
 * @subpackage model
 * @author     pinika
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class AppUser extends BaseAppUser
{
	/**
   * Check profile email
   *
   * @param string $email
   * @param integer $user_id
   * @return string
   */
  public static function checkProfileEmail($email, $user_id = 0)
  {
  	$has_error = Common::getEmailError($email);

  	if (!empty($has_error)) { return $has_error; }

  	if (AppUserTable::getInstance()->emailIsRepeated($email, $user_id)) { return 'The email is already registered'; }

  	return '';
  }
  
  /**
   * Check profile password
   *
   * @param string $password
   * @param string $repeated_password
   * @param boolean $no_empty
   * @return string
   */
  public static function checkProfilePassword($password, $repeated_password, $no_empty = NULL)
  {
  	if (!empty($password)) {
	  	$has_error = Common::getPasswordError($password);

	  	if (!empty($has_error)) { return $has_error; }

	  	if ($password != $repeated_password) { return 'The passwords do not match'; }
  	} else {
  		if (!$no_empty) { return 'Enter the password'; }
  	}
  	return '';
  }

  /**
   * Check if user is clear to execute action
   *
   * @param mixed $oUser
   * @param integer $user_id
   * @return boolean
   */
  public static function isClearToContinue($oUser = NULL, $user_id = 0)
  {
  	$granted = false;
  	$oUser = !$oUser ? AppUserTable::getInstance()->find($user_id) : $oUser;
  	$sessionUser = sfContext::getInstance()->getUser();

  	if ($oUser) {
	  	## can not process himself
	  	if ($sessionUser->getAttribute('user_id') != $oUser->getId()) {
	  		## super_admin privilege
	  		if ($sessionUser->hasCredential('super_admin')) { $granted = true; }
	  	}
  	}
  	return $granted;
  }

  /**
   * Override set password method | add automatic salt and sha1
   * @param string $password contraseña
   */
  public function setPassword($password)
  {
    $this->setSalt(MD5(uniqid(''))); //Random seed
    $this->_set('password', sha1($password . $this->getSalt())); //Override
  }

 /**
  * Password verification
  * 
  * @param string $password
  * @return boolean
  */
 public function checkPassword($password)
 {
    return sha1($password . $this->getSalt()) == $this->getPassword();
 }

 /**
  * Get if user is enable
  * @return boolean
  */
 public function IsEnabled() { return $this->getEnabled(); }

  /**
   * Override add automatic recover token
   */
  public function setNewRecoverToken()
  {
    $this->setRecoverToken(sha1(MD5(uniqid('')))); //Random seed
  }
  
  /**
   * Send password to salesman
   *
   * @param string $password
   * @param string $email
   * @param string $name
   */
  public static function sendPasswordToSalesman($password, $email, $name)
  {
  	sfProjectConfiguration::getActive()->loadHelpers(array("Url"));

		$sendEmail = ServiceOutgoingMessages::sendToSingleAccount
		(
			$name, $email,
			'home/passwordToSalesman',
  		array(
  			'subject'     => 'Sus datos de acceso para ilamarca.com',
  			'to_partial'  => array(
  				'email'     => $email,
  				'password'  => $password,
  				'url'       => url_for('home/index', true)
  			)
  		)
  	);
  }
  
  /**
   * Get salesman array from designated zones
   *
   * @param integer $salesman_id
   * @return array
   */
  public static function getArrayFromDesignatedZones($salesman_id)
  {
  	$a = array();
  	$zones = AppUserTable::getInstance()->getDesignatedZones($salesman_id);
  	
  	if ($zones) {
  		foreach ($zones as $value) {
  			$a[$value->getNeighborhoodId()] = $value->Neighborhood->getName();
  		}
  	}
  	return $a;
  }
  
} // end class