<?php

/**
 * OperationRealProperty form base class.
 *
 * @method OperationRealProperty getObject() Returns the current form's model object
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOperationRealPropertyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'operation_id'     => new sfWidgetFormInputHidden(),
      'real_property_id' => new sfWidgetFormInputHidden(),
      'price'            => new sfWidgetFormInputText(),
      'currency_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Currency'), 'add_empty' => false)),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'operation_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('operation_id')), 'empty_value' => $this->getObject()->get('operation_id'), 'required' => false)),
      'real_property_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('real_property_id')), 'empty_value' => $this->getObject()->get('real_property_id'), 'required' => false)),
      'price'            => new sfValidatorNumber(array('required' => false)),
      'currency_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Currency'))),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('operation_real_property[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OperationRealProperty';
  }

}
