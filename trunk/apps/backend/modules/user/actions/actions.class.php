<?php

/**
 * user actions.
 *
 * @package    sf_icox
 * @subpackage user
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->iPage  = $request->getParameter('page', 1);
  	$this->oPager = AppUserTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
  	$this->oList  = $this->oPager->getResults();
  }

  /**
   * Set filter
   *
   * @return string
   */
  protected function setFilter()
  {
  	$sessionUser = sfContext::getInstance()->getUser();
  	$sch_partial = 'id != '.$sessionUser->getAttribute('user_id');

  	## add user_role filter
  	if ($sessionUser->getAttribute('user_role') == 'company_admin') {
  		$sch_partial .= ' AND company_id = '.$sessionUser->getAttribute('user_company');
  	}
  	$this->f_params  = '';
		$this->sch_name  = trim($this->getRequestParameter('sch_name'));
		$this->sch_email = trim($this->getRequestParameter('sch_email'));

		if (!empty($this->sch_name)) {
			$sch_partial .= " AND name LIKE '%$this->sch_name%'";
			$this->f_params .= '&sch_name='.urlencode($this->sch_name);
		}
		if (!empty($this->sch_email)) {
			$sch_partial .= " AND email LIKE '%$this->sch_email%'";
			$this->f_params .= '&sch_email='.urlencode($this->sch_email);
		}
		return $sch_partial;
  }

  /**
   * Set list order
   *
   * @return string
   */
  protected function setOrderBy()
  {
  	$q_order = $this->getRequestParameter('o', 'name');	// order
  	$q_sort  = $this->getRequestParameter('s', 'asc');  // sort

  	$this->sort = $q_sort == 'asc' ? 'desc' : 'asc';
  	$this->pager_order = "&o=$q_order&s=$q_sort";

  	return "$q_order $q_sort";
  }

  /**
   * Executes create action
   *
   * @param sfWebRequest $request
   */
  public function executeRegister(sfWebRequest $request) { $this->forward('user', 'process'); }

  /**
	 * Executes edit action
	 *
	 * @param sfWebRequest $request
	 */
  public function executeEdit(sfWebRequest $request)
  {
  	if (!$request->getParameter('id') || !AppUser::isClearToContinue(NULL, $request->getParameter('id'))) {
  		$this->redirect('user/index');
  	}
  	$this->forward('user', 'process');
  }
  
  /**
   * Process form action
   *
   * @param sfWebRequest $request
   */
  public function executeProcess(sfWebRequest $request)
  {
  	$this->id = $request->getParameter('id');
  	$this->company   = 0;
  	$this->user_role = 0;
  	$this->email     = '';
  	$this->error     = array();
  	$this->photo     = NULL;
  	$entity_object   = NULL;

  	if ($this->id) {
  		$entity_object   = AppUserTable::getInstance()->find($this->id);
  		$this->company   = $entity_object->getCompanyId();
	  	$this->user_role = $entity_object->getUserRoleId();
	  	$this->email     = $entity_object->getEmail();
	  	$this->photo     = $entity_object->getPhoto();
  	}
  	$this->form = new AppUserForm($entity_object);

  	if ($request->getMethod() == 'POST') {
  		$this->email = trim($request->getParameter('email'));
  		$this->company = $request->getParameter('company');
  		$this->user_role = $request->getParameter('user_role');

  		$x_password = trim($request->getParameter('password'));
  		$r_password = trim($request->getParameter('repeat_password'));
  		
  		## check values
  		$check_email = AppUser::checkProfileEmail($this->email, $this->id);
  		$check_password = AppUser::checkProfilePassword($x_password, $r_password, $this->id);

  		if (empty($this->company))   { $this->error['company'] = 'Select the company'; }
  		if (empty($this->user_role)) { $this->error['user_role'] = 'Select the user role'; }
  		if (!empty($check_email))    { $this->error['email'] = $check_email; }
  		if (!empty($check_password)) { $this->error['password'] = $check_password; }

  		## continue
  		if (!$this->error) {
  			$form_request = $request->getParameter($this->form->getName());
  			$form_request['company_id'] = $this->company;
  			$form_request['user_role_id'] = $this->user_role;
  			$form_request['email'] = $this->email;

				$this->form->bind($form_request);

	  		if ($this->form->isValid()) {
	  			$recorded = $this->form->save();

	  			## set password
	  			if (!empty($x_password)) {
						$x_salt = MD5(uniqid(''));
						$x_pass = sha1($x_password.$x_salt);
	
						$recorded->setSalt($x_salt);
						$recorded->setPassword($x_pass);
	  			}	
	  			## set photo
	  			AppUserTable::getInstance()->uploadPhoto($request->getFiles('photo'), $recorded, $request->getParameter('reset_photo'));
	
	  			$this->redirect('user/show?id='.$recorded->getId());
	  		}
  		}
  	}
  	$this->setTemplate('form');
  }

  /**
   * Executes show action
   *
   * @param sfWebRequest $request
   */
  public function executeShow(sfWebRequest $request)
  {
  	$this->id = $request->getParameter('id');
  	$this->oValue = AppUserTable::getInstance()->find($this->id);

  	if (empty($this->id) || !AppUser::isClearToContinue($this->oValue)) { $this->redirect('user/index'); }
  }

  /**
   * Executes delete action
   *
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
  	$oValue = AppUserTable::getInstance()->find($request->getParameter('id'));

  	if ($oValue) {
  		if (AppUser::isClearToContinue($oValue)) {
  			## delete photo
	  		$destination = ServiceFileHandler::getUploadFolder('user');

	  		@unlink($destination.$oValue->getPhoto());
				@unlink($destination.ServiceFileHandler::getThumbImage($oValue->getPhoto()));

				## delete user
	  		$oValue->delete();
  		}
  	}
  	$this->redirect('user/index');
  }

} // end class