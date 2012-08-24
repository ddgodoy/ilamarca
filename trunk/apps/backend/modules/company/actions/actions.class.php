<?php

/**
 * company actions.
 *
 * @package    sf_icox
 * @subpackage company
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class companyActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->iPage  = $request->getParameter('page', 1);
  	$this->oPager = CompanyTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
  	$this->oList  = $this->oPager->getResults();
    $this->oCant  = $this->oPager->getNbResults();
  }

  /**
   * Set filter
   *
   * @return string
   */
  protected function setFilter()
  {
  	$sch_partial = 'id != '.sfContext::getInstance()->getUser()->getAttribute('user_company');
  	$this->f_params = '';
		$this->sch_name = trim($this->getRequestParameter('sch_name'));

		if (!empty($this->sch_name)) {
			$sch_partial .= " AND name LIKE '%$this->sch_name%'";
			$this->f_params .= '&sch_name='.urlencode($this->sch_name);
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
  public function executeRegister(sfWebRequest $request) { $this->forward('company', 'process'); }

  /**
	 * Executes edit action
	 *
	 * @param sfWebRequest $request
	 */
  public function executeEdit(sfWebRequest $request)
  {
  	if (!$request->getParameter('id') || $this->getUser()->getAttribute('user_company') == $request->getParameter('id')) {
  		$this->redirect('company/index');
  	}
  	$this->forward('company', 'process');
  }
  
  /**
   * Process form action
   *
   * @param sfWebRequest $request
   */
  public function executeProcess(sfWebRequest $request)
  {
  	$this->id = $request->getParameter('id');
  	$this->logo = NULL;
  	$entity_object = NULL;

  	if ($this->id) {
  		$entity_object = CompanyTable::getInstance()->find($this->id);
  		$this->logo = $entity_object->getLogo();
  	}
  	$this->form = new CompanyForm($entity_object);

  	if ($request->getMethod() == 'POST') {
  		$this->form->bind($request->getParameter($this->form->getName()));

  		if ($this->form->isValid()) {
  			$recorded = $this->form->save();

  			## set logo
  			CompanyTable::getInstance()->uploadLogo($request->getFiles('logo'), $recorded, $request->getParameter('reset_logo'));

  			$this->redirect('company/show?id='.$recorded->getId());
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

  	if (empty($this->id)) { $this->redirect('company/index'); }

  	$this->oValue = CompanyTable::getInstance()->find($this->id);
  }
  
  /**
   * Executes delete action
   *
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
  	$oValue = CompanyTable::getInstance()->find($request->getParameter('id'));

  	if ($oValue) {
  		## can not delete his own company
  		if ($this->getUser()->getAttribute('user_company') != $oValue->getId()) {
  			## delete logo
	  		$destination = ServiceFileHandler::getUploadFolder('company');
	  		@unlink($destination.$oValue->getLogo());
	
				## delete company
	  		$oValue->delete();
  		}
  	}
  	$this->redirect('company/index');
  }

} // end class