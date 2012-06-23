<?php

/**
 * City form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CityForm extends BaseCityForm
{
  public function configure()
  {
  	$i18N = sfContext::getInstance()->getI18N();
    $countrys = Country::getCountryForSelect();
    $geo_zone = GeoZoneTable::getInstance()->getAllForSelect(true);
    unset($geo_zone[0]);
  	$this->setWidgets(array(
      'name'        => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'geo_zone_id' => new sfWidgetFormInputHidden(),
      'country_id' => new sfWidgetFormChoice(array('choices'=> array(''=>'-- '.$i18N->__('Select').' --')+$countrys), array('class'=>'form_input', 'style'=>'width:408px;', 'id'=>'country', 'dir'=>'1'))
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorString(array('max_length' => 100), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
      'geo_zone_id' => new sfValidatorChoice(array('choices' => array_keys($geo_zone)),array('required'=>$i18N->__('Select the geo zone', NULL, 'errors'), 'invalid'=>$i18N->__('Select the geo zone', NULL, 'errors'))),
      'country_id' => new sfValidatorChoice(array('choices' => array_keys($countrys)),array('required'=>$i18N->__('Enter the country', NULL, 'errors'), 'invalid'=>$i18N->__('Enter the country', NULL, 'errors')))
    ));

    $this->widgetSchema->setNameFormat('city[%s]');
  }

} // end class