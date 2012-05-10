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
      'name'          => new sfWidgetFormFilterInput(),
      'detail'        => new sfWidgetFormFilterInput(),
      'address'       => new sfWidgetFormFilterInput(),
      'points_of_ref' => new sfWidgetFormFilterInput(),
      'transports'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'detail'        => new sfValidatorPass(array('required' => false)),
      'address'       => new sfValidatorPass(array('required' => false)),
      'points_of_ref' => new sfValidatorPass(array('required' => false)),
      'transports'    => new sfValidatorPass(array('required' => false)),
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
      'id'            => 'Number',
      'name'          => 'Text',
      'detail'        => 'Text',
      'address'       => 'Text',
      'points_of_ref' => 'Text',
      'transports'    => 'Text',
      'lang'          => 'Text',
    );
  }
}
