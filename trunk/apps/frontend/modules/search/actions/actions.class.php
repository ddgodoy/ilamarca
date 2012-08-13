<?php

/**
 * search actions.
 *
 * @package    ilamarca
 * @subpackage search
 * @author     pinika
 * @version    1
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
  	$str_filter = $this->setFilter();
    $this->index_url = sfContext::getInstance()->getController()->genUrl($request->getParameter('module').'/index');

    $array_data_currency = array('currency'=>$this->currency, 'p_desde'=>$this->p_desde, 'p_hasta'=>$this->p_hasta, 'operation'=>$this->operation);

  	$this->iPage  = $request->getParameter('page', 1);
  	$this->oPager = RealPropertyTable::getInstance()->searchResults(
  		$this->iPage, 9, $str_filter, $array_data_currency, $request->getMethod(), $request->getParameterHolder()->getAll()
  	);
  	$this->oList = $this->oPager->getResults();
  }

  /**
   * Set filter
   * 
   * @return string
   */
  protected function setFilter()
  {
  	$sch_partial = 'p.enabled = 1';
  	$this->f_params = '';

  	$this->property_type = $this->getRequestParameter('property_type', 0);
    $this->operation     = $this->getRequestParameter('operation', 0);
    $this->geo_zone      = $this->getRequestParameter('geo_zone', 0);
    $this->city          = $this->getRequestParameter('city', 0);
    $this->neighborhood  = $this->getRequestParameter('neighborhood', 0);
    $this->bedroom       = $this->getRequestParameter('bedroom', 0);
    $this->p_desde       = $this->getRequestParameter('p_from', '');
    $this->p_hasta       = $this->getRequestParameter('p_to', '');
    $this->currency      = $this->getRequestParameter('currency', 0);

    if (!empty($this->property_type)) {
      $sch_partial .= " AND p.property_type_id = $this->property_type";
      $this->f_params .= '&property_type='.$this->property_type;
    }
    if (!empty($this->geo_zone)) {
      $sch_partial .= " AND p.geo_zone_id = $this->geo_zone";
      $this->f_params .= '&geo_zone='.$this->geo_zone;
    }
    if (!empty($this->city)) {
      $sch_partial .= " AND p.city_id = $this->city";
      $this->f_params .= '&city='.$this->city;
    }
    if (!empty($this->neighborhood)) {
      $sch_partial .= " AND p.neighborhood_id = $this->neighborhood";
      $this->f_params .= '&neighborhood='.$this->neighborhood;
    }
    if (!empty($this->bedroom)) {
      $sch_partial .= " AND p.bedroom_id = $this->bedroom";
      $this->f_params .= '&bedroom='.$this->bedroom;
    }
    return $sch_partial;
  }
  
  /**
   * Executes ajax rec search in DB action
   *
   * @param sfRequest $request A request object
   */
  public function executeAjaxRecSearchInDB(sfWebRequest $request)
  {
  	$mensaje = '';
  	$may_rec = false;
  	$ss_user = sfContext::getInstance()->getUser();
  	$checkDB = SearchProfileTable::getInstance()->checkSearchAlreadySaved($ss_user);

  	if ($checkDB)
  	{
  		$obj = new SearchProfile();
  		$_user_id       = $ss_user->getAttribute('user_id');
  		$_bedroom       = $ss_user->getAttribute('sch_bedroom');
  		$_property_type = $ss_user->getAttribute('sch_property_type');
  		$_operation     = $ss_user->getAttribute('sch_operation');
  		$_geo_zone      = $ss_user->getAttribute('sch_geo_zone');
  		$_city          = $ss_user->getAttribute('sch_city');
  		$_neighborhood  = $ss_user->getAttribute('sch_neighborhood');
  		$_currency      = $ss_user->getAttribute('sch_currency');
  		$_p_from        = $ss_user->getAttribute('sch_p_from');
  		$_p_to          = $ss_user->getAttribute('sch_p_to');
  		$name_ref       = trim($request->getParameter('name_ref'));

  		if (!empty($_bedroom))       { $obj->setBedroomId($_bedroom);            $may_rec = true; }
  		if (!empty($_property_type)) { $obj->setPropertyTypeId($_property_type); $may_rec = true; }
  		if (!empty($_operation))     { $obj->setOperationId($_operation);        $may_rec = true; }
  		if (!empty($_geo_zone))      { $obj->setGeoZoneId($_geo_zone);           $may_rec = true; }
  		if (!empty($_city))          { $obj->setCityId($_city);                  $may_rec = true; }
  		if (!empty($_neighborhood))  { $obj->setNeighborhoodId($_neighborhood);  $may_rec = true; }
  		if (!empty($_currency))      { $obj->setCurrencyId($_currency);          $may_rec = true; }
  		if (!empty($_p_from))        { $obj->setMinPrice($_p_from);              $may_rec = true; }
  		if (!empty($_p_to))          { $obj->setMaxPrice($_p_to);                $may_rec = true; }

  		if (!$may_rec) {
  			$mensaje = 'No hay filtros para registrar';
  		} else {
  			$mensaje = 'La búsqueda fue registrada exitosamente';

  			$obj->setAppUserId($_user_id);
  			$obj->save();
  			
  			// set name for this search
  			if (empty($name_ref)) {
  				$name_ref = 'Búsqueda nro. '.sprintf("%04d", $obj->getId());
  			}
  			$obj->setName($name_ref);
  			$obj->save();

  			// rec in search_match table
  			SearchMatchTable::getInstance()->recBySearchConditions($ss_user->getAttribute('sch_filter'), $obj->getId(), $request->getHost());

  			// clear session values for search
  			myUser::clearSearchInSession();
  		}
  	}
  	return $this->renderText($mensaje); exit();
  }
  
  /**
   * Executes contact vendor action
   *
   * @param sfRequest $request A request object
   */
  public function executeContact(sfWebRequest $request)
  {
  	$this->pid = $request->getParameter('pid', 0);
  	$this->obj = RealPropertyTable::getInstance()->find($this->pid);
  	
  	if (!$this->obj) {
  		$this->redirect('home/index');
  	}
  	$this->error = '';
  	$this->messg = '';
  	$this->commt = trim($request->getParameter('p_comments', ''));
  	
  	if ($request->isMethod('POST'))
		{
			if (!empty($this->commt)) {
				$vendor_email = $this->obj->AppUser->getEmail();
				$vendor_name  = $this->obj->AppUser->getName().' '.$this->obj->AppUser->getLastName();
				$mail_titulo  = 'Contacto por una propiedad desde '.sfConfig::get('app_project_url_name');
				
				if ($vendor_email) {
					$sendEmail = ServiceOutgoingMessages::sendToSingleAccount(
						$vendor_name,
						$vendor_email,
						'search/mailToVendor',
						array(
			  			'subject'     => $mail_titulo,
			  			'to_partial'  => array(
			  				'titulo'    => $mail_titulo,
			  				'vendedor'  => $vendor_name,
			  				'cliente'   => $this->getUser()->getAttribute('user_name').' '.$this->getUser()->getAttribute('user_last_name'),
			  				'url_sitio' => sfConfig::get('app_project_url_name'),
			  				'backend'   => 'http://'.$request->getHost().'/admin'
			  			)
			  		)
					);
					// rec contact in DB
					$ctc = new SearchContact();
					$ctc->setAppUserId     ($this->getUser()->getAttribute('user_id'));
					$ctc->setRealPropertyId($this->pid);
					$ctc->setVendorId      ($this->obj->AppUser->getId());
					$ctc->setComments      ($this->commt);
					$ctc->save();	
				}
				$this->messg = 'ok';
  			$this->commt = '';
			} else {
				$this->error = 'error';
			}
		}
  }

} // end class