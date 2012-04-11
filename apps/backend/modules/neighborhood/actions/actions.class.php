<?php

/**
 * neighborhood actions.
 *
 * @package    sf_icox
 * @subpackage neighborhood
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class neighborhoodActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->iPage  = $request->getParameter('page', 1);
  	$this->oPager = NeighborhoodTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
  	$this->oList  = $this->oPager->getResults();
  }

  /**
   * Set filter
   *
   * @return string
   */
  protected function setFilter()
  {
  	$sch_partial = 'n.id > 0';
  	$this->f_params = '';
		$this->sch_name = trim($this->getRequestParameter('sch_name'));

		if (!empty($this->sch_name)) {
			$sch_partial .= " AND n.name LIKE '%$this->sch_name%'";
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
  	$q_order = $this->getRequestParameter('o', 'n.name');	// order
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
  public function executeRegister(sfWebRequest $request) { $this->forward('neighborhood', 'process'); }

  /**
	 * Executes edit action
	 *
	 * @param sfWebRequest $request
	 */
  public function executeEdit(sfWebRequest $request)
  {
  	if (!$request->getParameter('id')) {
  		$this->redirect('neighborhood/index');
  	}
  	$this->forward('neighborhood', 'process');
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
  	$this->city     = 0;
  	$this->error    = array();
  	$entity_object  = NULL;

  	if ($this->id) {
  		$entity_object  = NeighborhoodTable::getInstance()->find($this->id);
  		$this->geo_zone = $entity_object->City->getGeoZoneId();
  		$this->city     = $entity_object->getCityId();
  	}
  	$this->form = new NeighborhoodForm($entity_object);

  	if ($request->getMethod() == 'POST') {
  		$this->geo_zone = $request->getParameter('geo_zone');
  		$this->city = $request->getParameter('city');

  		if (empty($this->geo_zone)) { $this->error['geo_zone'] = 'Select the geo zone'; }
  		if (empty($this->city)) { $this->error['city'] = 'Select the city'; }

  		## continue
  		if (!$this->error) {
  			$form_request = $request->getParameter($this->form->getName());
  			$form_request['city_id'] = $this->city;

				$this->form->bind($form_request);

	  		if ($this->form->isValid()) {
	  			$recorded = $this->form->save();
	
	  			$this->redirect('neighborhood/show?id='.$recorded->getId());
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
  	$this->oValue = NeighborhoodTable::getInstance()->find($this->id);

  	if (empty($this->id)) { $this->redirect('neighborhood/index'); }
  }

  /**
   * Executes delete action
   *
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
  	$oValue = NeighborhoodTable::getInstance()->find($request->getParameter('id'));

  	if ($oValue) {
			$oValue->delete();
  	}
  	$this->redirect('neighborhood/index');
  }
  
  /**
   * Ajax get cities
   *
   * @param sfWebRequest $request
   */
  public function executeAjaxCity(sfWebRequest $request)
  {
    $this->geo_zone = $request->getParameter('geo_zone');

    return $this->renderPartial('neighborhood/ajaxCity'); exit();
  }

} // end class