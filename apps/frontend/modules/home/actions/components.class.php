<?php
/**
 * home Components.
 *
 * @package    sf_icox
 * @subpackage home
 * @author     mauro
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeComponents extends sfComponents
{
	/**
	 * Right block action
	 *
	 * @param sfWebRequest $request
	 */
  public function executeRight(sfWebRequest $request) { }

  /**
   * Search filter action
   *
   * @param sfWebRequest $request
   */
  public function executeFilter(sfWebRequest $request)
  {
    $this->db_properties = PropertyTypeTable::getInstance()->getAllForSelect(true, 'Property type');
    $this->db_operations = OperationTable::getInstance()->getAllForSelect(true, 'Operation');
    $this->db_geo_zones  = GeoZoneTable::getInstance()->getAllForSelect(true, 'Place');
    $this->db_bedrooms   = BedroomTable::getInstance()->getAllForSelect(true, 'Bedrooms');
    $this->db_currencies = CurrencyTable::getInstance()->getAllForSelect();

    $this->property_type = $this->getRequestParameter('property_type', 0);
    $this->operation     = $this->getRequestParameter('operation', 0);
    $this->geo_zone      = $this->getRequestParameter('geo_zone', 0);
    $this->city          = $this->getRequestParameter('city', 0);
    $this->neighborhood  = $this->getRequestParameter('neighborhood', 0);
    $this->bedroom       = $this->getRequestParameter('bedroom', 0);
    $this->p_desde       = $this->getRequestParameter('p_from', 0);
    $this->p_hasta       = $this->getRequestParameter('p_to', 0);
    $this->currency      = $this->getRequestParameter('currency', 0);
  }

} // end class