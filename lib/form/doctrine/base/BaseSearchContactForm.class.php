<?php

/**
 * SearchContact form base class.
 *
 * @method SearchContact getObject() Returns the current form's model object
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSearchContactForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'app_user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'real_property_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RealProperty'), 'add_empty' => true)),
      'vendor_id'        => new sfWidgetFormInputText(),
      'comments'         => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'app_user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'required' => false)),
      'real_property_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RealProperty'), 'required' => false)),
      'vendor_id'        => new sfValidatorInteger(array('required' => false)),
      'comments'         => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('search_contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SearchContact';
  }

}
