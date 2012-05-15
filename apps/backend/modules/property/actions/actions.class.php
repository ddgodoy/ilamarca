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
  	$this->oPager = RealPropertyTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy(), $this->getUser()->getCulture());
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
			$sch_partial .= " AND t.name LIKE '%$this->sch_name%'";
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
  	$q_order = $this->getRequestParameter('o', 't.name');	// order
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

		$this->geo_zone      = 0;
		$this->city          = 0;
		$this->neighborhood  = 0;
		$this->property_type = 0;
		$this->bedroom       = 1;
		$this->error         = array();
		$this->videos        = array();
		$entity_object       = NULL;
		
		if ($this->id) {
			$entity_object = RealPropertyTable::getInstance()->find($this->id);

			$this->geo_zone      = $entity_object->getGeoZoneId();
			$this->city          = $entity_object->getCityId();
			$this->neighborhood  = $entity_object->getNeighborhoodId();
			$this->property_type = $entity_object->getPropertyTypeId();
			$this->bedroom       = $entity_object->getBedroomId();
			$this->videos        = VideoTable::getInstance()->getPropertyVideos($this->id);
		}
		$this->form = new RealPropertyForm($entity_object);

		if ($request->getMethod() == 'POST')
		{
			$this->geo_zone      = $request->getParameter('geo_zone');
			$this->city          = $request->getParameter('city');
			$this->neighborhood  = $request->getParameter('neighborhood');
			$this->bedroom       = $request->getParameter('bedroom');
			$this->property_type = $request->getParameter('property_type');
			$this->videos        = $request->getParameter('videos', array());

			if (empty($this->property_type)) { $this->error['property_type'] = 'Select the property type'; }
			if (empty($this->neighborhood))  { $this->error['neighborhood']  = 'Select the neighborhood'; }

			## continue
			if (!$this->error)
			{
				$form_request = $request->getParameter($this->form->getName());

				$form_request['geo_zone_id']      = $this->geo_zone;
				$form_request['city_id']          = $this->city;
				$form_request['neighborhood_id']  = $this->neighborhood;
				$form_request['bedroom_id']       = $this->bedroom;
				$form_request['property_type_id'] = $this->property_type;
				$form_request['app_user_id']      = $this->getUser()->getAttribute('user_id');
			
				if (empty($form_request['en']['name'])) {
					$form_request['en']['name'] = ' ';
				}
				$this->form->bind($form_request);

				if ($this->form->isValid()) {
					$recorded = $this->form->save();					
					$recorded->setUpdated(date('Y-m-d H:i:s'));
					$recorded->save();

					// set videos
          VideoTable::getInstance()->setPropertyVideos($recorded->getId(), $this->videos);

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

  /**
   * ajax images
   * @param sfWebRequest $request
   */
  public function executeAjaxImages(sfWebRequest $request)
  {
    $id_gallery = $request->getParameter('id_gallery');
    $id_property = $request->getParameter('id_property');
    
    $path_local = Gallery::getPath($id_property,1);

    $gallery = GalleryTable::getInstance()->findOneById($id_gallery);

    $array_prefix = array('','c_','m_');

    foreach ($array_prefix as $v) {
      @unlink($path_local.$v.$gallery->getInternalName());
    }
    
    $gallery_delete = GalleryTable::getInstance()->deleteGallery($id_gallery);

    return $this->renderComponent('property', 'gallery', array('id'=>$id_property));
    exit();
  }

} // end class