<?php

/**
 * MoreInfoRealProperty form base class.
 *
 * @method MoreInfoRealProperty getObject() Returns the current form's model object
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMoreInfoRealPropertyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'real_property_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'real_property_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('real_property_id')), 'empty_value' => $this->getObject()->get('real_property_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('more_info_real_property[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MoreInfoRealProperty';
  }

}
