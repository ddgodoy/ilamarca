<?php

/**
 * country actions.
 *
 * @package    sf_icox
 * @subpackage country
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class countryActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->iPage  = $request->getParameter('page', 1);
  	$this->oPager = CountryTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
  	$this->oList  = $this->oPager->getResults();
  }
  
  /**
   * Set filter
   *
   * @return string
   */
  protected function setFilter()
  {
  	$sch_partial = 'id > 0';

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
  public function executeRegister(sfWebRequest $request) { $this->forward('country', 'process'); }

  /**
	 * Executes edit action
	 *
	 * @param sfWebRequest $request
	 */
  public function executeEdit(sfWebRequest $request)
  {
  	if (!$request->getParameter('id')) {
  		$this->redirect('country/index');
  	}
  	$this->forward('country', 'process');
  }
  
  /**
   * Process form action
   *
   * @param sfWebRequest $request
   */
  public function executeProcess(sfWebRequest $request)
  {
  	$this->id = $request->getParameter('id');
  	$entity_object = NULL;

  	if ($this->id) {
  		$entity_object = CountryTable::getInstance()->find($this->id);
  	}
  	$this->form = new CountryForm($entity_object);

  	if ($request->getMethod() == 'POST')
  	{
			$form_request = $request->getParameter($this->form->getName());
            $form_request['name'] = $i18N = sfContext::getInstance()->getI18N()->getCountry($form_request['iso']);
            $form_request['iso'] = strtolower($form_request['iso']);
			$this->form->bind($form_request);

  		if ($this->form->isValid()) {
  			$recorded = $this->form->save();

  			$this->redirect('country/show?id='.$recorded->getId());
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
  	$this->oValue = CountryTable::getInstance()->find($this->id);

  	if (empty($this->id)) { $this->redirect('country/index'); }
  }

  /**
   * Executes delete action
   *
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
  	$oValue = CountryTable::getInstance()->find($request->getParameter('id'));

  	if ($oValue) {
  		$oValue->delete();
  	}
  	$this->redirect('country/index');
  }

} // end class