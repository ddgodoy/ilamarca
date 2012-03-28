<?php

/**
 * SearchProfile form base class.
 *
 * @method SearchProfile getObject() Returns the current form's model object
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSearchProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'property_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'), 'add_empty' => true)),
      'operation_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Operation'), 'add_empty' => true)),
      'geo_zone_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GeoZone'), 'add_empty' => true)),
      'city_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
      'neighborhood_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'), 'add_empty' => true)),
      'app_user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'min_price'        => new sfWidgetFormInputText(),
      'max_price'        => new sfWidgetFormInputText(),
      'is_vendor'        => new sfWidgetFormInputCheckbox(),
      'reference'        => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'property_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'), 'required' => false)),
      'operation_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Operation'), 'required' => false)),
      'geo_zone_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GeoZone'), 'required' => false)),
      'city_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => false)),
      'neighborhood_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'), 'required' => false)),
      'app_user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'required' => false)),
      'min_price'        => new sfValidatorNumber(array('required' => false)),
      'max_price'        => new sfValidatorNumber(array('required' => false)),
      'is_vendor'        => new sfValidatorBoolean(array('required' => false)),
      'reference'        => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('search_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SearchProfile';
  }

}
