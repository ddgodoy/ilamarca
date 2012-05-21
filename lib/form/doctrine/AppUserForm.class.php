<?php
/**
 * AppUser form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AppUserForm extends BaseAppUserForm
{
  public function configure()
  {
      $user_name = '';

      $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'last_name'     => new sfWidgetFormInputText(),
      'email'         => new sfWidgetFormInputText(),
      're_email'      => new sfWidgetFormInputText(),
      'photo'         => new sfWidgetFormInputText(),
      'password'      => new sfWidgetFormInputPassword(),
      're_password'   => new sfWidgetFormInputPassword(),
      'captcha'       => new sfWidgetFormReCaptcha(array('public_key' => sfConfig::get('app_recaptcha_public_key'))),
      'company_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Company'), 'add_empty' => false)),
      'user_role_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserRole'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required' => '<em>Este campo es obligatorio</em>')),
      'last_name'     => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required' => '<em>Este campo es obligatorio</em>')),
      'email'         => new sfValidatorEmail(array(),array('invalid'=>'<em>Introduce un E-mail válido</em>', 'required' => '<em>Este campo es obligatorio</em>')),
      're_email'      => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required' => '<em>Este campo es obligatorio</em>','max_length'=>'<em>E-mail no valido</em>')),
      'photo'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'password'      => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required' => '<em>Este campo es obligatorio</em>','max_length'=>'<em>Contraseña no valida</em>')),
      're_password'   => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required' => '<em>Este campo es obligatorio</em>','max_length'=>'<em>Contraseña no valida</em>')),
      'captcha'       => new sfValidatorReCaptcha(array('private_key' => sfConfig::get('app_recaptcha_private_key')),array('captcha'=>'Ingrese las palabras que ve en la imagen')),
      'company_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Company'))),
      'user_role_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserRole'))),
    ));

    // validator for user login

    $v = new sfValidatorSchemaCompare('email', sfValidatorSchemaCompare::EQUAL, 're_email', array(), array('invalid' =>'<em>Los E-mails no son iguales</em>'));
    if($user_name && $this->getObject()->isNew())
    {
        $v = new sfValidatorSchemaCompare('user_name', sfValidatorSchemaCompare::EQUAL, $user_name, array(), array('invalid'=>'<em>El E-mail ya está registrado</em>'));
    }

    $this->validatorSchema->setPostValidator(
       new sfValidatorAnd(
       array($v,
             new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 're_password', array(), array('invalid' => '<em> Las contraseñas no son iguales</em>'))
       )));

    $this->widgetSchema->setNameFormat('app_user[%s]');
  }
}