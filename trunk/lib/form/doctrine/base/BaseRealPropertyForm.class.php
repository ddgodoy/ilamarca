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
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'status'           => new sfWidgetFormInputText(),
      'google_map'       => new sfWidgetFormInputText(),
      'ground'           => new sfWidgetFormInputText(),
      'covered_meters'   => new sfWidgetFormInputText(),
      'age'              => new sfWidgetFormInputText(),
      'owner'            => new sfWidgetFormInputText(),
      'phone'            => new sfWidgetFormInputText(),
      'email'            => new sfWidgetFormInputText(),
      'pool'             => new sfWidgetFormInputCheckbox(),
      'service_dept'     => new sfWidgetFormInputCheckbox(),
      'balcony'          => new sfWidgetFormInputCheckbox(),
      'rotisserie'       => new sfWidgetFormInputCheckbox(),
      'desk'             => new sfWidgetFormInputCheckbox(),
      'bedroom_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bedroom'), 'add_empty' => false)),
      'property_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'), 'add_empty' => false)),
      'geo_zone_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GeoZone'), 'add_empty' => false)),
      'city_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => false)),
      'neighborhood_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'), 'add_empty' => false)),
      'app_user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => false)),
      'updated'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 250)),
      'status'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'google_map'       => new sfValidatorPass(array('required' => false)),
      'ground'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'covered_meters'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'age'              => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'owner'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'phone'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email'            => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'pool'             => new sfValidatorBoolean(array('required' => false)),
      'service_dept'     => new sfValidatorBoolean(array('required' => false)),
      'balcony'          => new sfValidatorBoolean(array('required' => false)),
      'rotisserie'       => new sfValidatorBoolean(array('required' => false)),
      'desk'             => new sfValidatorBoolean(array('required' => false)),
      'bedroom_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bedroom'))),
      'property_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'))),
      'geo_zone_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GeoZone'))),
      'city_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'))),
      'neighborhood_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'))),
      'app_user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'))),
      'updated'          => new sfValidatorPass(array('required' => false)),
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
