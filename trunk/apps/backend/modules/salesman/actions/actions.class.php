<?php

/**
 * salesman actions.
 *
 * @package    sf_icox
 * @subpackage salesman
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class salesmanActions extends sfActions
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
  	$sch_partial = 'id != '.$sessionUser->getAttribute('user_id'). ' AND user_role_id = 3';

  	$this->f_params  = '';
		$this->sch_name  = trim($this->getRequestParameter('sch_name'));
		$this->sch_email = trim($this->getRequestParameter('sch_email'));

		if (!empty($this->sch_name)) {
			$sch_partial .= " AND (name LIKE '%$this->sch_name%' OR last_name LIKE '%$this->sch_name%')";
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
  public function executeRegister(sfWebRequest $request) { $this->forward('salesman', 'process'); }

  /**
	 * Executes edit action
	 *
	 * @param sfWebRequest $request
	 */
  public function executeEdit(sfWebRequest $request)
  {
  	if (!$request->getParameter('id') || !AppUser::isClearToContinue(NULL, $request->getParameter('id'))) {
  		$this->redirect('salesman/index');
  	}
  	$this->forward('salesman', 'process');
  }
  
  /**
   * Process form action
   *
   * @param sfWebRequest $request
   */
  public function executeProcess(sfWebRequest $request)
  {
  	$this->id = $request->getParameter('id');
  	$this->email   = '';
  	$this->error   = array();
  	$this->photo   = NULL;
  	$entity_object = NULL;
  	$send_password = false;

  	if ($this->id) {
  		$entity_object = AppUserTable::getInstance()->find($this->id);
	  	$this->email   = $entity_object->getEmail();
	  	$this->photo   = $entity_object->getPhoto();
  	}
  	$this->form = new SalesmanForm($entity_object);

  	if ($request->getMethod() == 'POST') {
  		$this->email = trim($request->getParameter('email'));
  		$x_password  = trim($request->getParameter('password'));
  		$r_password  = trim($request->getParameter('repeat_password'));

  		## check values
  		$check_email = AppUser::checkProfileEmail($this->email, $this->id);
  		$check_password = AppUser::checkProfilePassword($x_password, $r_password, $this->id);

  		if (!empty($check_email))    { $this->error['email'] = $check_email; }
  		if (!empty($check_password)) { $this->error['password'] = $check_password; }

  		$form_request = $request->getParameter($this->form->getName());
			$form_request['company_id']   = 1;
			$form_request['user_role_id'] = 3;
			$form_request['email']        = $this->email;

			$this->form->bind($form_request);

  		## continue
  		if ($this->form->isValid() && !$this->error) {
  			$recorded = $this->form->save();

  			## set password
  			if (!empty($x_password)) {
					$x_salt = MD5(uniqid(''));
					$x_pass = sha1($x_password.$x_salt);

					$recorded->setSalt($x_salt);
					$recorded->setPassword($x_pass);

					$send_password = true;
  			}
  			## set photo
  			AppUserTable::getInstance()->uploadPhoto($request->getFiles('photo'), $recorded, $request->getParameter('reset_photo'));

  			## send password to salesman
  			if ($send_password) { AppUser::sendPasswordToSalesman($x_password, $this->email, $recorded->getName().' '.$recorded->getLastName()); }

  			$this->redirect('salesman/show?id='.$recorded->getId());
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

  	if (empty($this->id) || !AppUser::isClearToContinue($this->oValue)) { $this->redirect('salesman/index'); }
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
  	$this->redirect('salesman/index');
  }

} // end class