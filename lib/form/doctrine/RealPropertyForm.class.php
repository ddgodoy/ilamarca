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
    $this->setWidgets(array(
      'bedroom_id'         => new sfWidgetFormInputHidden(),
      'property_type_id'   => new sfWidgetFormInputHidden(),
      'geo_zone_id'        => new sfWidgetFormInputHidden(),
      'city_id'            => new sfWidgetFormInputHidden(),
      'neighborhood_id'    => new sfWidgetFormInputHidden(),
      'app_user_id'        => new sfWidgetFormInputHidden(),
      'google_map'         => new sfWidgetFormTextarea(array(), array('class'=>'form_input', 'style'=>'width:500px;height:62px;')),
      'square_meters'      => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:100px;text-align:right;')),
      'covered_area'       => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:100px;text-align:right;')),
      'years_antiquity'    => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:47px;text-align:right;')),
      'qty_bathrooms'      => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:47px;text-align:right;')),
      'has_garage'         => new sfWidgetFormInputCheckbox(),
      'has_swimming_pool'  => new sfWidgetFormInputCheckbox(),
      'has_dep_of_service' => new sfWidgetFormInputCheckbox(),
      'has_balcony'        => new sfWidgetFormInputCheckbox(),
      'has_bbq'            => new sfWidgetFormInputCheckbox(),
      'owner_name'         => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:250px;')),
      'owner_phone'        => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:200px;')),
      'owner_email'        => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:310px;')),
    ));

    $this->setValidators(array(
      'bedroom_id'         => new sfValidatorInteger(),
      'property_type_id'   => new sfValidatorInteger(),
      'geo_zone_id'        => new sfValidatorInteger(),
      'city_id'            => new sfValidatorInteger(),
      'neighborhood_id'    => new sfValidatorInteger(),
      'app_user_id'        => new sfValidatorInteger(),
      'google_map'         => new sfValidatorPass(array('required' => false)),
      'square_meters'      => new sfValidatorInteger(array('required' => false)),
      'covered_area'       => new sfValidatorInteger(array('required' => false)),
      'years_antiquity'    => new sfValidatorInteger(array('required' => false)),
      'qty_bathrooms'      => new sfValidatorInteger(array('required' => false)),
      'has_garage'         => new sfValidatorBoolean(array('required' => false)),
      'has_swimming_pool'  => new sfValidatorBoolean(array('required' => false)),
      'has_dep_of_service' => new sfValidatorBoolean(array('required' => false)),
      'has_balcony'        => new sfValidatorBoolean(array('required' => false)),
      'has_bbq'            => new sfValidatorBoolean(array('required' => false)),
      'owner_name'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'owner_phone'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'owner_email'        => new sfValidatorString(array('max_length' => 250, 'required' => false)),
    ));
		$this->embedI18n(array('es', 'en'));

    $this->widgetSchema->setNameFormat('real_property[%s]');
  }

} // end class