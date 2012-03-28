<?php

/**
 * GoogleMap form base class.
 *
 * @method GoogleMap getObject() Returns the current form's model object
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGoogleMapForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'map_content'      => new sfWidgetFormInputText(),
      'real_property_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RealProperty'), 'add_empty' => false)),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'map_content'      => new sfValidatorPass(array('required' => false)),
      'real_property_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RealProperty'))),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('google_map[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GoogleMap';
  }

}
