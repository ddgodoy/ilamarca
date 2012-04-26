<?php

/**
 * MoreInfoRealPropertyTranslation form base class.
 *
 * @method MoreInfoRealPropertyTranslation getObject() Returns the current form's model object
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMoreInfoRealPropertyTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'real_property_id' => new sfWidgetFormInputHidden(),
      'detail'           => new sfWidgetFormInputText(),
      'toilets'          => new sfWidgetFormInputText(),
      'garages'          => new sfWidgetFormInputText(),
      'expense_security' => new sfWidgetFormInputText(),
      'writing_plans'    => new sfWidgetFormInputText(),
      'benchmarks'       => new sfWidgetFormInputText(),
      'transport'        => new sfWidgetFormInputText(),
      'observations'     => new sfWidgetFormInputText(),
      'address'          => new sfWidgetFormInputText(),
      'lang'             => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'real_property_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('real_property_id')), 'empty_value' => $this->getObject()->get('real_property_id'), 'required' => false)),
      'detail'           => new sfValidatorPass(array('required' => false)),
      'toilets'          => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'garages'          => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'expense_security' => new sfValidatorPass(array('required' => false)),
      'writing_plans'    => new sfValidatorPass(array('required' => false)),
      'benchmarks'       => new sfValidatorPass(array('required' => false)),
      'transport'        => new sfValidatorPass(array('required' => false)),
      'observations'     => new sfValidatorPass(array('required' => false)),
      'address'          => new sfValidatorPass(array('required' => false)),
      'lang'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('more_info_real_property_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MoreInfoRealPropertyTranslation';
  }

}
