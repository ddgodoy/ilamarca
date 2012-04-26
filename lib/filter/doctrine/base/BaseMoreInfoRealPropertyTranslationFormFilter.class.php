<?php

/**
 * MoreInfoRealPropertyTranslation filter form base class.
 *
 * @package    sf_icox
 * @subpackage filter
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMoreInfoRealPropertyTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'detail'           => new sfWidgetFormFilterInput(),
      'toilets'          => new sfWidgetFormFilterInput(),
      'garages'          => new sfWidgetFormFilterInput(),
      'expense_security' => new sfWidgetFormFilterInput(),
      'writing_plans'    => new sfWidgetFormFilterInput(),
      'benchmarks'       => new sfWidgetFormFilterInput(),
      'transport'        => new sfWidgetFormFilterInput(),
      'observations'     => new sfWidgetFormFilterInput(),
      'address'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'detail'           => new sfValidatorPass(array('required' => false)),
      'toilets'          => new sfValidatorPass(array('required' => false)),
      'garages'          => new sfValidatorPass(array('required' => false)),
      'expense_security' => new sfValidatorPass(array('required' => false)),
      'writing_plans'    => new sfValidatorPass(array('required' => false)),
      'benchmarks'       => new sfValidatorPass(array('required' => false)),
      'transport'        => new sfValidatorPass(array('required' => false)),
      'observations'     => new sfValidatorPass(array('required' => false)),
      'address'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('more_info_real_property_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MoreInfoRealPropertyTranslation';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'real_property_id' => 'Number',
      'detail'           => 'Text',
      'toilets'          => 'Text',
      'garages'          => 'Text',
      'expense_security' => 'Text',
      'writing_plans'    => 'Text',
      'benchmarks'       => 'Text',
      'transport'        => 'Text',
      'observations'     => 'Text',
      'address'          => 'Text',
      'lang'             => 'Text',
    );
  }
}
