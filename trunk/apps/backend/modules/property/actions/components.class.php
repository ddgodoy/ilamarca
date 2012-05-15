<?php
/**
 * property Components.
 *
 * @package    sf_icox
 * @subpackage property
 * @author     mauro
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class propertyComponents extends sfComponents
{
	/**
	 * Image list action
	 *
	 * @param sfWebRequest $request
	 */
  public function executeGallery(sfWebRequest $request)
  {
    $this->path    = Gallery::getPath($this->id).'c_';
    $this->gallery = GalleryTable::getInstance()->getGalleryByProperty($this->id);
    $this->cant    = count($this->gallery);
  }

} // end class