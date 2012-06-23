<?php

/**
 * GeoZone form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GeoZoneForm extends BaseGeoZoneForm
{
  public function configure()
  {
  	$i18N = sfContext::getInstance()->getI18N();
    $countrys = Country::getCountryForSelect();

  	$this->setWidgets(array(
      'name' => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:330px;')),
      'country_id' => new sfWidgetFormChoice(array('choices'=> array(''=>$i18N->__('Select'))+$countrys), array('class'=>'form_input', 'style'=>'width:337px;'))
    ));

    $this->setValidators(array(
      'name' => new sfValidatorString(array('max_length' => 100), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
      'country_id' => new sfValidatorChoice(array('choices' => array_keys($countrys)),array('required'=>$i18N->__('Enter the country', NULL, 'errors')))
    ));

    $this->widgetSchema->setNameFormat('geo_zone[%s]');
  }

} // end class