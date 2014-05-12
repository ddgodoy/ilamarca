<?php

/**
 * RealPropertyTranslation form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RealPropertyTranslationForm extends BaseRealPropertyTranslationForm
{
  public function configure()
  {
  	$i18N = sfContext::getInstance()->getI18N();

  	$this->setWidgets(array(
      'name'       => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:450px;')),
      'detail'     => new sfWidgetFormTextarea(array(), array('class'=>'form_input', 'style'=>'width:500px;height:150px;')),
      'address'    => new sfWidgetFormTextarea(array(), array('class'=>'form_input', 'style'=>'width:450px;height:101px;')),
      'transports' => new sfWidgetFormTextarea(array(), array('class'=>'form_input', 'style'=>'width:450px;height:50px;')),
        'points_of_ref' => new sfWidgetFormTextarea(array(), array('class'=>'form_input', 'style'=>'width:450px;height:101px;')),
    ));

    $this->setValidators(array(
      'name'       => new sfValidatorString(array('required' => true), array('required' => $i18N->__('Enter the name', NULL, 'errors'))),
      'detail'     => new sfValidatorPass(array('required' => false)),
      'address'    => new sfValidatorPass(array('required' => false)),
      'transports' => new sfValidatorPass(array('required' => false)),
      'points_of_ref' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('real_property_translation[%s]');
  }

} // end class