<?php

/**
 * geo_zone actions.
 *
 * @package    sf_icox
 * @subpackage geo_zone
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class geo_zoneActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->iPage  = $request->getParameter('page', 1);
  	$this->oPager = GeoZoneTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
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
  	$sch_partial = 'id > 0';

    $this->country = Country::getCountryForSelect();
  	$this->f_params = '';
    $this->sch_name = trim($this->getRequestParameter('sch_name'));
    $this->sch_country = trim($this->getRequestParameter('sch_country'));

    if (!empty($this->sch_name)) {
        $sch_partial .= " AND name LIKE '%$this->sch_name%'";
        $this->f_params .= '&sch_name='.urlencode($this->sch_name);
    }

    if (!empty($this->sch_country)) {
			$sch_partial .= " AND country_id = $this->sch_country ";
			$this->f_params .= '&sch_country='.urlencode($this->sch_country);
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
  public function executeRegister(sfWebRequest $request) { $this->forward('geo_zone', 'process'); }

  /**
	 * Executes edit action
	 *
	 * @param sfWebRequest $request
	 */
  public function executeEdit(sfWebRequest $request)
  {
  	if (!$request->getParameter('id')) {
  		$this->redirect('geo_zone/index');
  	}
  	$this->forward('geo_zone', 'process');
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
  		$entity_object = GeoZoneTable::getInstance()->find($this->id);
  	}
  	$this->form = new GeoZoneForm($entity_object);

  	if ($request->getMethod() == 'POST')
  	{
			$form_request = $request->getParameter($this->form->getName());

			$this->form->bind($form_request);

  		if ($this->form->isValid()) {
  			$recorded = $this->form->save();

  			$this->redirect('geo_zone/show?id='.$recorded->getId());
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
  	$this->oValue = GeoZoneTable::getInstance()->find($this->id);

  	if (empty($this->id)) { $this->redirect('geo_zone/index'); }
  }

  /**
   * Executes delete action
   *
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
  	$oValue = GeoZoneTable::getInstance()->find($request->getParameter('id'));

  	if ($oValue) {
  		$oValue->delete();
  	}
  	$this->redirect('geo_zone/index');
  }

  public function executeGetGeoZone(sfWebRequest $request)
  {
    $country_id = $request->getParameter('country', '');
    $is_neighborhood = $request->getParameter('is_neighborhood', false);
    $is_property = $request->getParameter('is_property', false);

    return $this->renderComponent('geo_zone', 'geoZone', array('geo_zone'=>'', 'country_id'=>$country_id, 'is_neighborhood'=>$is_neighborhood, 'w'=>$is_property));
    exit();
  }

} // end class