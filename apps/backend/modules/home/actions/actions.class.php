<?php

/**
 * home actions.
 *
 * @package    sf_icox
 * @subpackage home
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->sch_name = trim($request->getParameter('sch_name'));

  	$this->searchs = SearchProfileTable::getInstance()->getSearchsForAdminUser(
  		$this->getUser()->getAttribute('user_id'), $this->sch_name
  	);
  }

  /**
   * Update user profile
   *
   * @param sfWebRequest $request
   */
  public function executeMyProfile(sfWebRequest $request)
  {
  	$sessionUser = sfContext::getInstance()->getUser();
  	$oUser = AppUserTable::getInstance()->find($sessionUser->getAttribute('user_id'));

  	$this->my_go_ok = false;
  	$this->my_error = array();
  	$this->my_email = $oUser->getEmail();
  	$this->my_name  = $oUser->getName();
  	$this->my_lname = $oUser->getLastName();

  	if ($request->getMethod() == 'POST') {
  		$this->my_email = trim($request->getParameter('my_email'));
  		$this->my_name  = trim($request->getParameter('my_name'));
  		$this->my_lname = trim($request->getParameter('my_last_name'));

  		$x_password = trim($request->getParameter('my_password'));
  		$r_password = trim($request->getParameter('my_repeat_password'));

  		## check values
  		$check_email = AppUser::checkProfileEmail($this->my_email, $oUser->getId());
  		$check_password = AppUser::checkProfilePassword($x_password, $r_password, true);

  		if (!empty($check_email))    { $this->my_error['email']    = $check_email; }
  		if (!empty($check_password)) { $this->my_error['password'] = $check_password; }
  		if (empty($this->my_name))   { $this->my_error['name']     = 'Enter the name'; }
  		if (empty($this->my_lname))  { $this->my_error['last_name']= 'Enter the last name'; }

  		## continue
  		if (!$this->my_error) {
  			## set photo
  			AppUserTable::getInstance()->uploadPhoto($request->getFiles('my_photo'), $oUser, $request->getParameter('my_reset_photo'));

  			$oUser->setEmail   ($this->my_email);
  			$oUser->setName    ($this->my_name);
  			$oUser->setLastName($this->my_lname);

  			if (!empty($x_password)) {
					$oUser->setPassword($x_password);
  			}
  			$oUser->save();

  			## update session user data
  			$sessionUser->setAttribute('user_name', $oUser->getName());
				$sessionUser->setAttribute('user_photo', $oUser->getPhoto());

  			$this->my_go_ok = true;
  		}
  	}
  }

  /**
   * Executes logout action
   *
   * @param sfWebRequest $request
   */
  public function executeLogout(sfWebRequest $request)
  {  	
  	ServiceAuthentication::closeSessionProcess();

  	$this->redirect('home/index');
  }
  
  /**
   * Update user company info
   *
   * @param sfWebRequest $request
   */
  public function executeMyCompany(sfWebRequest $request)
  {
  	if (!$this->getUser()->hasCredential('company_admin')) {
  		$this->redirect('home/index');
  	}
  	$this->ok = false;
  	$this->id = $this->getUser()->getAttribute('user_company');
  	$entity_object = CompanyTable::getInstance()->find($this->id);

  	$this->logo = $entity_object->getLogo();
  	$this->form = new CompanyForm($entity_object);

  	if ($request->getMethod() == 'POST') {
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()) {
  			$recorded = $this->form->save();

  			## set logo
  			CompanyTable::getInstance()->uploadLogo($request->getFiles('logo'), $recorded, $request->getParameter('reset_logo'));

  			$this->logo = $recorded->getLogo();
  			$this->ok = true;
	}}}

} // end class