<?php

/**
 * RealPropertyTranslation filter form base class.
 *
 * @package    sf_icox
 * @subpackage filter
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRealPropertyTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'detail' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'detail' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('real_property_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RealPropertyTranslation';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'detail' => 'Text',
      'lang'   => 'Text',
    );
  }
}
