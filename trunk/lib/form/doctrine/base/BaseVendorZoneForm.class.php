<?php

/**
 * VendorZone form base class.
 *
 * @method VendorZone getObject() Returns the current form's model object
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVendorZoneForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'app_user_id'     => new sfWidgetFormInputHidden(),
      'neighborhood_id' => new sfWidgetFormInputHidden(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'app_user_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('app_user_id')), 'empty_value' => $this->getObject()->get('app_user_id'), 'required' => false)),
      'neighborhood_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('neighborhood_id')), 'empty_value' => $this->getObject()->get('neighborhood_id'), 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('vendor_zone[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VendorZone';
  }

}
