<?php

/**
 * SearchProfile filter form base class.
 *
 * @package    sf_icox
 * @subpackage filter
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSearchProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'property_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'), 'add_empty' => true)),
      'operation_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Operation'), 'add_empty' => true)),
      'geo_zone_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GeoZone'), 'add_empty' => true)),
      'city_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
      'neighborhood_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'), 'add_empty' => true)),
      'app_user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'min_price'        => new sfWidgetFormFilterInput(),
      'max_price'        => new sfWidgetFormFilterInput(),
      'currency_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Currency'), 'add_empty' => true)),
      'is_vendor'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'reference'        => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'property_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PropertyType'), 'column' => 'id')),
      'operation_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Operation'), 'column' => 'id')),
      'geo_zone_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GeoZone'), 'column' => 'id')),
      'city_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('City'), 'column' => 'id')),
      'neighborhood_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Neighborhood'), 'column' => 'id')),
      'app_user_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AppUser'), 'column' => 'id')),
      'min_price'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'max_price'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'currency_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Currency'), 'column' => 'id')),
      'is_vendor'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'reference'        => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('search_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SearchProfile';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'property_type_id' => 'ForeignKey',
      'operation_id'     => 'ForeignKey',
      'geo_zone_id'      => 'ForeignKey',
      'city_id'          => 'ForeignKey',
      'neighborhood_id'  => 'ForeignKey',
      'app_user_id'      => 'ForeignKey',
      'min_price'        => 'Number',
      'max_price'        => 'Number',
      'currency_id'      => 'ForeignKey',
      'is_vendor'        => 'Boolean',
      'reference'        => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
