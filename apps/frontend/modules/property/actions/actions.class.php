<?php
/**
 * property actions.
 *
 * @package    ilamarca
 * @subpackage property
 * @author     pinika
 * @version    1
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
    $id = $request->getParameter('id');

    $this->property = RealPropertyTable::getInstance()->findOneById($id);
    $this->images   = GalleryTable::getInstance()->getGalleryByProperty($id);
    $this->videos   = VideoTable::getInstance()->findOneBy('real_property_id', $id);

    $this->latitude  =  $this->property->getLatitude()?$this->property->getLatitude():'';
    $this->longitude =  $this->property->getLongitude()?$this->property->getLongitude():'';
    
    
    $this->m2_sup_cubierta = $this->property->getCoveredArea();
	$this->m2_sup_terreno  = $this->property->getSquareMeters();
    $this->years_antiquity = $this->property->getYearsAntiquity();
    $this->qty_bathrooms   = $this->property->getQtyBathrooms();
	$this->get_google_map  = $this->property->getGoogleMap();
	$this->_down_pdf_file  = $this->property->getPdfFile();
    $this->qrcode_img      = $this->property->getQrCode();
    $this->url_site        = 'http://'.$request->getHost().'/property?id='.$id;

    if ($request->isMethod('POST'))
    {
      $_parameter    = $request->getParameter('contac');
      $destinatarios = array($_parameter['email_friend'] => $_parameter['email_friend']);

      $array_data = array('subject'   => $_parameter['name'].' quiere compartir una propiedad',
                          'to_partial'=> array(
                          	'nombre'    	=> $_parameter['name'],
                          	'email'     	=> $_parameter['email'],  
                          	'email_friend'=> $_parameter['email_friend'],
                          	'comment'			=> $_parameter['message'],
                          	'url'					=> $this->url_site  
                          ));
      $sendEmail = ServiceOutgoingMessages::sendToMultipleAccounts($destinatarios, 'home/mailFromSharer',  $array_data);

      EmailShare::NewEmailShare($_parameter, $this->url_site);

      $this->getUSer()->setFlash('notice', 'La propiedad fue compartida con éxito');
      $this->redirect('property/index?id='.$id);
    }
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