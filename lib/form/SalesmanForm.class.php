<?php
/**
 * AppUser form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SalesmanForm extends BaseAppUserForm
{
  public function configure()
  {
  	$i18N = sfContext::getInstance()->getI18N();

  	$this->setWidgets(array(
      'name'          => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:330px;')),
      'last_name'     => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:330px;')),
      'email'         => new sfWidgetFormInputText(),
      'enabled'       => new sfWidgetFormInputCheckbox(),
      'company_id'    => new sfWidgetFormInputHidden(),
      'user_role_id'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
      'last_name'     => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required'=>$i18N->__('Enter the last name', NULL, 'errors'))),
      'email'         => new sfValidatorString(array('max_length' => 200)),
      'enabled'       => new sfValidatorBoolean(array('required' => false)),
      'company_id'    => new sfValidatorInteger(),
      'user_role_id'  => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('salesman[%s]');
  }

} // end class