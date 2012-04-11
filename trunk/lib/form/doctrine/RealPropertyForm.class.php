<?php

/**
 * RealProperty form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RealPropertyForm extends BaseRealPropertyForm
{
  public function configure()
  {
  	$i18N = sfContext::getInstance()->getI18N();		
  	
  	$this->setWidgets(array(
      'name'             => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:330px;')),
      'detail'           => new sfWidgetFormTextarea(array(), array('class'=>'form_input', 'style'=>'width:330px;height:100px;')),
      'property_type_id' => new sfWidgetFormInputHidden(),
      'neighborhood_id'  => new sfWidgetFormInputHidden(),
      'app_user_id'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorString(array('max_length' => 250), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
      'detail'           => new sfValidatorPass(array('required' => false)),
      'property_type_id' => new sfValidatorInteger(),
      'neighborhood_id'  => new sfValidatorInteger(),
      'app_user_id'      => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('real_property[%s]');
  }

} // end class