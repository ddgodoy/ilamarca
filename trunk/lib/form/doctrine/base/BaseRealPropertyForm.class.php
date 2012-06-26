<?php

/**
 * RealProperty form base class.
 *
 * @method RealProperty getObject() Returns the current form's model object
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRealPropertyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'google_map'         => new sfWidgetFormInputText(),
      'pdf_file'           => new sfWidgetFormInputText(),
      'qr_code'            => new sfWidgetFormInputText(),
      'square_meters'      => new sfWidgetFormInputText(),
      'covered_area'       => new sfWidgetFormInputText(),
      'years_antiquity'    => new sfWidgetFormInputText(),
      'qty_bathrooms'      => new sfWidgetFormInputText(),
      'has_garage'         => new sfWidgetFormInputCheckbox(),
      'has_swimming_pool'  => new sfWidgetFormInputCheckbox(),
      'has_dep_of_service' => new sfWidgetFormInputCheckbox(),
      'has_balcony'        => new sfWidgetFormInputCheckbox(),
      'has_bbq'            => new sfWidgetFormInputCheckbox(),
      'owner_name'         => new sfWidgetFormInputText(),
      'owner_phone'        => new sfWidgetFormInputText(),
      'owner_email'        => new sfWidgetFormInputText(),
      'bedroom_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bedroom'), 'add_empty' => false)),
      'property_type_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'), 'add_empty' => false)),
      'country_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => false)),
      'geo_zone_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GeoZone'), 'add_empty' => false)),
      'city_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => false)),
      'neighborhood_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'), 'add_empty' => false)),
      'app_user_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => false)),
      'updated'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'google_map'         => new sfValidatorPass(array('required' => false)),
      'pdf_file'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'qr_code'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
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
      'bedroom_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bedroom'))),
      'property_type_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'))),
      'country_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'))),
      'geo_zone_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GeoZone'))),
      'city_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'))),
      'neighborhood_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'))),
      'app_user_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'))),
      'updated'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('real_property[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RealProperty';
  }

}
