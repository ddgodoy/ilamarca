<?php

/**
 * RealProperty form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RealPropertyForm extends BaseRealPropertyForm
{
  public function configure()
  {
    $i18N = sfContext::getInstance()->getI18N();

    $this->setWidgets(array(
      'name'             => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:600px;')),
      'google_map'       => new sfWidgetFormTextarea(array(), array('class'=>'form_input area_yt', 'style'=>'height:150px;')),
      'ground'           => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:600px;')),
      'covered_meters'   => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:600px;')),
      'age'              => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:600px;')),
      'owner'            => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:600px;')),
      'phone'            => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:600px;')),
      'email'            => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:600px;')),
      'pool'             => new sfWidgetFormInputCheckbox(),
      'service_dept'     => new sfWidgetFormInputCheckbox(),
      'balcony'          => new sfWidgetFormInputCheckbox(),
      'rotisserie'       => new sfWidgetFormInputCheckbox(),
      'desk'             => new sfWidgetFormInputCheckbox(),
      'bedroom_id'       => new sfWidgetFormInputHidden(),
      'property_type_id' => new sfWidgetFormInputHidden(),
      'geo_zone_id'      => new sfWidgetFormInputHidden(),
      'city_id'          => new sfWidgetFormInputHidden(),
      'neighborhood_id'  => new sfWidgetFormInputHidden(),
      'app_user_id'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorString(array('max_length' => 250), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
      'google_map'       => new sfValidatorPass(array('required' => false)),
      'ground'           => new sfValidatorRegex(array('pattern' => '/^[[:digit:]]+$/', 'required' => false),array('invalid'=>$i18N->__('The ground seems incorrect', NULL, 'errors'))),
      'covered_meters'   => new sfValidatorRegex(array('pattern' => '/^[[:digit:]]+$/', 'required' => false),array('invalid'=>$i18N->__('The covered_meters seems incorrect', NULL, 'errors'))),
      'age'              => new sfValidatorRegex(array('pattern' => '/^[[:digit:]]+$/', 'required' => false),array('invalid'=>$i18N->__('The age seems incorrect', NULL, 'errors'))),
      'owner'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'phone'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email'            => new sfValidatorEmail(array('required' => false),array('invalid'=>$i18N->__('The email seems incorrect', NULL, 'errors'))),
      'pool'             => new sfValidatorBoolean(array('required' => false)),
      'service_dept'     => new sfValidatorBoolean(array('required' => false)),
      'balcony'          => new sfValidatorBoolean(array('required' => false)),
      'rotisserie'       => new sfValidatorBoolean(array('required' => false)),
      'desk'             => new sfValidatorBoolean(array('required' => false)),
      'bedroom_id'       => new sfValidatorInteger(),
      'property_type_id' => new sfValidatorInteger(),
      'geo_zone_id'      => new sfValidatorInteger(),
      'city_id'          => new sfValidatorInteger(),
      'neighborhood_id'  => new sfValidatorInteger(),
      'app_user_id'      => new sfValidatorInteger(),
    ));
    //$this->embedI18n(array('es', 'en'));

    $this->setDefaults(array('ground'=>0,
                             'covered_meters'=>0,   
    ));

    $this->widgetSchema->setNameFormat('real_property[%s]');
  }

} // end class