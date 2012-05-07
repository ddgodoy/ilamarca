<?php

/**
 * RealProperty filter form base class.
 *
 * @package    sf_icox
 * @subpackage filter
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRealPropertyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'           => new sfWidgetFormFilterInput(),
      'google_map'       => new sfWidgetFormFilterInput(),
      'ground'           => new sfWidgetFormFilterInput(),
      'covered_meters'   => new sfWidgetFormFilterInput(),
      'age'              => new sfWidgetFormFilterInput(),
      'owner'            => new sfWidgetFormFilterInput(),
      'phone'            => new sfWidgetFormFilterInput(),
      'email'            => new sfWidgetFormFilterInput(),
      'pool'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'service_dept'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'balcony'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'rotisserie'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'desk'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'bedroom_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bedroom'), 'add_empty' => true)),
      'property_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'), 'add_empty' => true)),
      'geo_zone_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GeoZone'), 'add_empty' => true)),
      'city_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
      'neighborhood_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'), 'add_empty' => true)),
      'app_user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'updated'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'status'           => new sfValidatorPass(array('required' => false)),
      'google_map'       => new sfValidatorPass(array('required' => false)),
      'ground'           => new sfValidatorPass(array('required' => false)),
      'covered_meters'   => new sfValidatorPass(array('required' => false)),
      'age'              => new sfValidatorPass(array('required' => false)),
      'owner'            => new sfValidatorPass(array('required' => false)),
      'phone'            => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
      'pool'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'service_dept'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'balcony'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'rotisserie'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'desk'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'bedroom_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bedroom'), 'column' => 'id')),
      'property_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PropertyType'), 'column' => 'id')),
      'geo_zone_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GeoZone'), 'column' => 'id')),
      'city_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('City'), 'column' => 'id')),
      'neighborhood_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Neighborhood'), 'column' => 'id')),
      'app_user_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AppUser'), 'column' => 'id')),
      'updated'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('real_property_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RealProperty';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'status'           => 'Text',
      'google_map'       => 'Text',
      'ground'           => 'Text',
      'covered_meters'   => 'Text',
      'age'              => 'Text',
      'owner'            => 'Text',
      'phone'            => 'Text',
      'email'            => 'Text',
      'pool'             => 'Boolean',
      'service_dept'     => 'Boolean',
      'balcony'          => 'Boolean',
      'rotisserie'       => 'Boolean',
      'desk'             => 'Boolean',
      'bedroom_id'       => 'ForeignKey',
      'property_type_id' => 'ForeignKey',
      'geo_zone_id'      => 'ForeignKey',
      'city_id'          => 'ForeignKey',
      'neighborhood_id'  => 'ForeignKey',
      'app_user_id'      => 'ForeignKey',
      'updated'          => 'Date',
    );
  }
}
