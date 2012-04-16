<?php

/**
 * property actions.
 *
 * @package    sf_icox
 * @subpackage property
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class propertyActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->iPage  = $request->getParameter('page', 1);
  	$this->oPager = RealPropertyTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
  	$this->oList  = $this->oPager->getResults();
  }

  /**
   * Set filter
   *
   * @return string
   */
  protected function setFilter()
  {
  	$sch_partial = 'p.id > 0';
  	$this->f_params = '';
		$this->sch_name = trim($this->getRequestParameter('sch_name'));

		if (!empty($this->sch_name)) {
			$sch_partial .= " AND p.name LIKE '%$this->sch_name%'";
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
  	$q_order = $this->getRequestParameter('o', 'p.name');	// order
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
  public function executeRegister(sfWebRequest $request) { $this->forward('property', 'process'); }

  /**
	 * Executes edit action
	 *
	 * @param sfWebRequest $request
	 */
  public function executeEdit(sfWebRequest $request)
  {
  	if (!$request->getParameter('id')) {
  		$this->redirect('property/index');
  	}
  	$this->forward('property', 'process');
  }
  
  /**
   * Process form action
   *
   * @param sfWebRequest $request
   */
  public function executeProcess(sfWebRequest $request)
  {
  	$this->id = $request->getParameter('id');
  	$this->property_type = 0;
  	$this->geo_zone      = 0;
  	$this->city          = 0;
  	$this->neighborhood  = 0;
  	$this->operations    = array();
  	$this->currencies    = array();
  	$this->prices        = array();
  	$this->error         = array();
  	$entity_object       = NULL;
        $this->db_operations = OperationTable::getInstance()->getAllForSelect();
        $this->sl_operations = array();
        $this->sl_currencies = array();
        $this->sl_prices     = array();

  	if ($this->id) {
  		$entity_object = RealPropertyTable::getInstance()->find($this->id);

  		$this->property_type = $entity_object->getPropertyTypeId();
	  	$this->geo_zone      = $entity_object->Neighborhood->City->getGeoZoneId();
	  	$this->city          = $entity_object->Neighborhood->getCityId();
	  	$this->neighborhood  = $entity_object->getNeighborhoodId();
                $a_operations_values = OperationRealProperty::getDataOperationsByPropertyId($this->id);
	  	$this->sl_operations = $a_operations_values['operations'];
	  	$this->sl_currencies = $a_operations_values['currencies'];
	  	$this->sl_prices     = $a_operations_values['prices'];
  	}
  	$this->form = new RealPropertyForm($entity_object);

  	if ($request->getMethod() == 'POST')
  	{
  		$this->property_type = $request->getParameter('property_type');
  		$this->geo_zone      = $request->getParameter('geo_zone');
  		$this->city          = $request->getParameter('city');
	  	$this->neighborhood  = $request->getParameter('neighborhood');
	  	$this->operations    = $request->getParameter('operations');
	  	$this->currencies    = $request->getParameter('currencies');
	  	$this->prices        = $request->getParameter('prices');

                $this->sl_operations = $request->getParameter('operations');
                $this->sl_currencies = $request->getParameter('currencies');
                $this->sl_prices     = $request->getParameter('prices');


  		if (empty($this->property_type))         { $this->error['property_type'] = 'Select the property type'; }
  		if (empty($this->neighborhood))          { $this->error['neighborhood'] = 'Select the neighborhood'; }
                if (count($this->sl_operations)==0)      { $this->error['operations'] = 'Select the operations'; }
                if (count($this->sl_currencies)==0)      { $this->error['currencies'] = 'Select the currencies'; }
                $sum_array = 0;
                if (count($this->sl_prices)!=0 )
                {
                    foreach ($this->sl_prices as $k=>$value) {
                       if($value['number']=='0.00' && in_array($k, $this->sl_operations) )
                       {
                           $this->error['prices'] = 'Enter the prices';
                       }
                    }
                    
                }
                
  		## continue
  		if (!$this->error) {
                        $form_request = $request->getParameter($this->form->getName());
                        $form_request['property_type_id'] = $this->property_type;
                        $form_request['neighborhood_id'] = $this->neighborhood;
                        $form_request['app_user_id'] = $this->getUser()->getAttribute('user_id');

                        $this->form->bind($form_request);

		        if ($this->form->isValid()) {
	  			$recorded = $this->form->save();

                                if(!$this->form->isNew())
                                {
                                    $operation_delete = OperationRealPropertyTable::getInstance()->deleteOperationsByProperty($recorded->getId());
                                }

                                foreach ($this->sl_operations as $v)
                                {
                                    $operation = new OperationRealProperty;
                                    $operation->setOperationId($v);
                                    $operation->setCurrencyId($this->sl_currencies[$v]['id']);
                                    $operation->setPrice($this->sl_prices[$v]['number']);
                                    $operation->setRealPropertyId($recorded->getId());
                                    $operation->save();
                                }


	  			$this->redirect('property/show?id='.$recorded->getId());
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
  	$this->oValue = RealPropertyTable::getInstance()->find($this->id);

  	if (empty($this->id)) { $this->redirect('property/index'); }
  }

  /**
   * Executes delete action
   *
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
  	$oValue = RealPropertyTable::getInstance()->find($request->getParameter('id'));

  	if ($oValue) {
			$oValue->delete();
  	}
  	$this->redirect('property/index');
  }
  
  /**
   * Ajax get cities
   *
   * @param sfWebRequest $request
   */
  public function executeAjaxCity(sfWebRequest $request)
  {
    $this->geo_zone = $request->getParameter('geo_zone');

    return $this->renderPartial('property/ajaxCity'); exit();
  }
  
  /**
   * Ajax get neighborhoods
   *
   * @param sfWebRequest $request
   */
  public function executeAjaxNeighborhood(sfWebRequest $request)
  {
    $this->city = $request->getParameter('city');

    return $this->renderPartial('property/ajaxNeighborhood'); exit();
  }

} // end class