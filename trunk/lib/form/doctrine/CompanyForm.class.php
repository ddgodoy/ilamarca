<?php

/**
 * Company form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CompanyForm extends BaseCompanyForm
{
  public function configure()
  {
  	$i18N = sfContext::getInstance()->getI18N();

  	$this->setWidgets(array(
      'name'          => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:330px;')),
      'email'         => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:330px;')),
      'address'       => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:330px;')),
      'phone'         => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:330px;')),
      'pop3_host'     => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:200px;')),
      'pop3_user'     => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:200px;')),
      'pop3_password' => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:200px;')),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorString(array('max_length' => 50), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
      'email'         => new sfValidatorEmail(array('max_length' => 200, 'required' => false), array('invalid'=>$i18N->__('The email seems incorrect', NULL, 'errors'))),
      'address'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'pop3_host'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'pop3_user'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'pop3_password' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('company[%s]');
  }

} // end class