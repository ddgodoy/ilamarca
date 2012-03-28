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
      'youtube'          => new sfWidgetFormInputText(),
      'status'           => new sfWidgetFormInputText(),
      'property_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'), 'add_empty' => false)),
      'neighborhood_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'), 'add_empty' => false)),
      'app_user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 250)),
      'youtube'          => new sfValidatorPass(array('required' => false)),
      'status'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'property_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PropertyType'))),
      'neighborhood_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'))),
      'app_user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'))),
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
