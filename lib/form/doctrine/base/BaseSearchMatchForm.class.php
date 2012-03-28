<?php

/**
 * SearchMatch form base class.
 *
 * @method SearchMatch getObject() Returns the current form's model object
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSearchMatchForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'search_profile_id' => new sfWidgetFormInputHidden(),
      'real_property_id'  => new sfWidgetFormInputHidden(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'search_profile_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('search_profile_id')), 'empty_value' => $this->getObject()->get('search_profile_id'), 'required' => false)),
      'real_property_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('real_property_id')), 'empty_value' => $this->getObject()->get('real_property_id'), 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('search_match[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SearchMatch';
  }

}
