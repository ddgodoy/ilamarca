<?php

/**
 * city actions.
 *
 * @package    sf_icox
 * @subpackage city
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cityActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->iPage  = $request->getParameter('page', 1);
  	$this->oPager = CityTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
  	$this->oList  = $this->oPager->getResults();
  }

  /**
   * Set filter
   *
   * @return string
   */
  protected function setFilter()
  {
  	$sch_partial = 'c.id > 0';
  	$this->f_params = '';
		$this->sch_name = trim($this->getRequestParameter('sch_name'));

		if (!empty($this->sch_name)) {
			$sch_partial .= " AND c.name LIKE '%$this->sch_name%'";
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
  	$q_order = $this->getRequestParameter('o', 'c.name');	// order
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
  public function executeRegister(sfWebRequest $request) { $this->forward('city', 'process'); }

  /**
	 * Executes edit action
	 *
	 * @param sfWebRequest $request
	 */
  public function executeEdit(sfWebRequest $request)
  {
  	if (!$request->getParameter('id')) {
  		$this->redirect('city/index');
  	}
  	$this->forward('city', 'process');
  }
  
  /**
   * Process form action
   *
   * @param sfWebRequest $request
   */
  public function executeProcess(sfWebRequest $request)
  {
  	$this->id = $request->getParameter('id');
  	$this->geo_zone = 0;
  	$this->error    = array();
  	$entity_object  = NULL;

  	if ($this->id) {
  		$entity_object  = CityTable::getInstance()->find($this->id);
  		$this->geo_zone = $entity_object->getGeoZoneId();
  	}
  	$this->form = new CityForm($entity_object);

  	if ($request->getMethod() == 'POST') {
  		$this->geo_zone = $request->getParameter('geo_zone');

  		if (empty($this->geo_zone)) { $this->error['geo_zone'] = 'Select the geo zone'; }

  		## continue
  		if (!$this->error) {
  			$form_request = $request->getParameter($this->form->getName());
  			$form_request['geo_zone_id'] = $this->geo_zone;

				$this->form->bind($form_request);

	  		if ($this->form->isValid()) {
	  			$recorded = $this->form->save();
	
	  			$this->redirect('city/show?id='.$recorded->getId());
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
  	$this->oValue = CityTable::getInstance()->find($this->id);

  	if (empty($this->id)) { $this->redirect('city/index'); }
  }

  /**
   * Executes delete action
   *
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
  	$oValue = CityTable::getInstance()->find($request->getParameter('id'));

  	if ($oValue) {
			$oValue->delete();
  	}
  	$this->redirect('city/index');
  }

} // end class