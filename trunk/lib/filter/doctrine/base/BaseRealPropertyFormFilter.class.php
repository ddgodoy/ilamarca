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
      'property_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'), 'add_empty' => true)),
      'neighborhood_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'), 'add_empty' => true)),
      'app_user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'status'           => new sfValidatorPass(array('required' => false)),
      'property_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PropertyType'), 'column' => 'id')),
      'neighborhood_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Neighborhood'), 'column' => 'id')),
      'app_user_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AppUser'), 'column' => 'id')),
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
      'property_type_id' => 'ForeignKey',
      'neighborhood_id'  => 'ForeignKey',
      'app_user_id'      => 'ForeignKey',
    );
  }
}
