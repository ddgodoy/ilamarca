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
      'google_map'         => new sfWidgetFormFilterInput(),
      'square_meters'      => new sfWidgetFormFilterInput(),
      'covered_area'       => new sfWidgetFormFilterInput(),
      'years_antiquity'    => new sfWidgetFormFilterInput(),
      'qty_bathrooms'      => new sfWidgetFormFilterInput(),
      'has_garage'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_swimming_pool'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_dep_of_service' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_balcony'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_bbq'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'owner_name'         => new sfWidgetFormFilterInput(),
      'owner_phone'        => new sfWidgetFormFilterInput(),
      'owner_email'        => new sfWidgetFormFilterInput(),
      'bedroom_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bedroom'), 'add_empty' => true)),
      'property_type_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'), 'add_empty' => true)),
      'geo_zone_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GeoZone'), 'add_empty' => true)),
      'city_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
      'neighborhood_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'), 'add_empty' => true)),
      'app_user_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'updated'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'google_map'         => new sfValidatorPass(array('required' => false)),
      'square_meters'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'covered_area'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'years_antiquity'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'qty_bathrooms'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'has_garage'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_swimming_pool'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_dep_of_service' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_balcony'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_bbq'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'owner_name'         => new sfValidatorPass(array('required' => false)),
      'owner_phone'        => new sfValidatorPass(array('required' => false)),
      'owner_email'        => new sfValidatorPass(array('required' => false)),
      'bedroom_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bedroom'), 'column' => 'id')),
      'property_type_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PropertyType'), 'column' => 'id')),
      'geo_zone_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GeoZone'), 'column' => 'id')),
      'city_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('City'), 'column' => 'id')),
      'neighborhood_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Neighborhood'), 'column' => 'id')),
      'app_user_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AppUser'), 'column' => 'id')),
      'updated'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
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
      'id'                 => 'Number',
      'google_map'         => 'Text',
      'square_meters'      => 'Number',
      'covered_area'       => 'Number',
      'years_antiquity'    => 'Number',
      'qty_bathrooms'      => 'Number',
      'has_garage'         => 'Boolean',
      'has_swimming_pool'  => 'Boolean',
      'has_dep_of_service' => 'Boolean',
      'has_balcony'        => 'Boolean',
      'has_bbq'            => 'Boolean',
      'owner_name'         => 'Text',
      'owner_phone'        => 'Text',
      'owner_email'        => 'Text',
      'bedroom_id'         => 'ForeignKey',
      'property_type_id'   => 'ForeignKey',
      'geo_zone_id'        => 'ForeignKey',
      'city_id'            => 'ForeignKey',
      'neighborhood_id'    => 'ForeignKey',
      'app_user_id'        => 'ForeignKey',
      'updated'            => 'Date',
    );
  }
}
