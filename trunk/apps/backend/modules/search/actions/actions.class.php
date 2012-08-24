<?php
/**
 * search actions.
 *
 * @package    sf_icox
 * @subpackage search
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->iPage  = $request->getParameter('page', 1);
  	$this->oPager = SearchContactTable::getInstance()->getSearchPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
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
  	$sch_partial = 'sp.app_user_id = '.sfContext::getInstance()->getUser()->getAttribute('user_id');

  	$this->f_params = '';
		$this->sch_name = trim($this->getRequestParameter('sch_name'));

		if (!empty($this->sch_name)) {
			$sch_partial .= " AND (sp.name LIKE '%$this->sch_name%' OR sp.reference LIKE '%$this->sch_name%')";
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
  	$q_order = $this->getRequestParameter('o', 'sp.created_at');	// order
  	$q_sort  = $this->getRequestParameter('s', 'desc');  // sort

  	$this->sort = $q_sort == 'asc' ? 'desc' : 'asc';
  	$this->pager_order = "&o=$q_order&s=$q_sort";

  	return "$q_order $q_sort";
  }
  
  /**
   * Executes create action
   *
   * @param sfWebRequest $request
   */
  public function executeRegister(sfWebRequest $request) { $this->forward('search', 'process'); }
  
  /**
   * Process form action
   *
   * @param sfWebRequest $request
   */
  public function executeProcess(sfWebRequest $request)
  {
  	$this->db_properties = PropertyTypeTable::getInstance()->getAllForSelect(true, 'Property type');
    $this->db_operations = OperationTable::getInstance()->getAllForSelect(true, 'Operation');
    $this->db_geo_zones  = GeoZoneTable::getInstance()->getAllForSelect(true, 'Place');
    $this->db_bedrooms   = BedroomTable::getInstance()->getAllForSelect(true, 'Bedrooms');
    $this->db_currencies = CurrencyTable::getInstance()->getAllForSelect();
    
    $this->error = '';
    $this->sel_tipo      = $request->getParameter('property_type', 0);
    $this->sel_operacion = $request->getParameter('operation', 0);
    $this->sel_geo_zone  = $request->getParameter('geo_zone', 0);
    $this->sel_city      = $request->getParameter('city', 0);
    $this->sel_neighbor  = $request->getParameter('neighborhood', 0);
    $this->sel_currency  = $request->getParameter('currency', 0);
    $this->sel_bedroom   = $request->getParameter('bedroom', 0);
    $this->p_nombre      = trim($request->getParameter('p_nombre', ''));
    $this->p_referencia  = trim($request->getParameter('p_referencia', ''));
    $this->p_from        = trim($request->getParameter('p_from', ''));
    $this->p_to          = trim($request->getParameter('p_to', ''));

  	if ($request->getMethod() == 'POST')
  	{
  		if (empty($this->p_nombre) || empty($this->p_referencia)) {
  			$this->error = 'Complete los campos obligatorios';
  		} else {
  			$may_rec = false;
	  		$obj = new SearchProfile();
				
				if (!empty($this->sel_bedroom))   { $obj->setBedroomId($this->sel_bedroom);      $may_rec = true; }
	  		if (!empty($this->sel_tipo)) 			{ $obj->setPropertyTypeId($this->sel_tipo);		 $may_rec = true; }
	  		if (!empty($this->sel_operacion)) { $obj->setOperationId($this->sel_operacion);  $may_rec = true; }
	  		if (!empty($this->sel_geo_zone))  { $obj->setGeoZoneId($this->sel_geo_zone);     $may_rec = true; }
	  		if (!empty($this->sel_city))      { $obj->setCityId($this->sel_city);            $may_rec = true; }
	  		if (!empty($this->sel_neighbor))  { $obj->setNeighborhoodId($this->sel_neighbor);$may_rec = true; }
	  		if (!empty($this->sel_currency))  { $obj->setCurrencyId($this->sel_currency);    $may_rec = true; }
	  		if (!empty($this->p_from))        { $obj->setMinPrice($this->p_from);            $may_rec = true; }
	  		if (!empty($this->p_to))          { $obj->setMaxPrice($this->p_to);              $may_rec = true; }	
	  		
	  		if (!$may_rec) {
	  			$this->error = 'No hay filtros para registrar';
	  		} else {
	  			$obj->setName     ($this->p_nombre);
	  			$obj->setReference($this->p_referencia);
	  			$obj->setAppUserId(sfContext::getInstance()->getUser()->getAttribute('user_id'));
  				$obj->save();

  				$this->getUser()->setFlash('new_search_added', true);
  				$this->redirect('search/index');
	  		}
  		}
  	}
  	$this->setTemplate('form');
  }
  
  /**
   * Ajax get cities
   *
   * @param sfWebRequest $request
   */
  public function executeAjaxCity(sfWebRequest $request)
  {
    $this->geo_zone = $request->getParameter('geo_zone');

    return $this->renderPartial('search/ajaxCity'); exit();
  }
  
  /**
   * Ajax get neighborhoods
   *
   * @param sfWebRequest $request
   */
  public function executeAjaxNeighborhood(sfWebRequest $request)
  {
    $this->city = $request->getParameter('city');

    return $this->renderPartial('search/ajaxNeighborhood'); exit();
  }
  
  /**
   * Executes show action
   *
   * @param sfWebRequest $request
   */
  public function executeShow(sfWebRequest $request)
  {
  	$this->id = $request->getParameter('id');
  	$this->oValue = SearchProfileTable::getInstance()->find($this->id);

  	if (empty($this->id)) { $this->redirect('search/index'); }
  }

  /**
   * Executes delete action
   *
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
  	$oValue = SearchProfileTable::getInstance()->find($request->getParameter('id'));

  	if ($oValue) {
  		$oValue->delete();
  	}
  	$this->redirect('search/index');
  }

} // end class