<?php

class geo_zoneComponents extends sfComponents
{
  public function executeGeoZone(sfWebRequest $request)
  {
    $i18N = sfContext::getInstance()->getI18N();
    if($this->country_id != '')
    {
      $this->geo_zone_select = GeoZoneTable::getInstance()->getAllForSelect(true,'Select',$this->country_id);
    }
    else
    {
      $this->geo_zone_select = array(''=>'-- '.$i18N->__('Select').' --');
    }
    
  }
}
?>