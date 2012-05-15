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
    $this->images = GalleryTable::getInstance()->findBy('real_property_id',$id);
    $this->videos = VideoTable::getInstance()->findOneBy('real_property_id',$id);
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