<?php
/**
 * AppUser form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AppUserProfileForm extends BaseAppUserForm
{
  private $requets = '';
  private $oUser = '';

  public function configure()
  {
      $this->requets = sfContext::getInstance()->getRequest();
      $this->oUser = sfContext::getInstance()->getUser();

      $values = $this->requets->getParameter($this->getName());
      
      $user_name = !empty($values['email'])?AppUser::checkProfileEmail($values['email']):'';

      $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'last_name'     => new sfWidgetFormInputText(),
      'address'       => new sfWidgetFormInputText(),
      'photo'         => new sfWidgetFormInputFile(),
      'phone'         => new sfWidgetFormInputText(),
      'email'         => new sfWidgetFormInputText(),
      're_email'      => new sfWidgetFormInputText(),
      'password'      => new sfWidgetFormInputPassword(),
      're_password'   => new sfWidgetFormInputPassword(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required' => '<em>Este campo es obligatorio</em>')),
      'last_name'     => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required' => '<em>Este campo es obligatorio</em>')),
      'address'       => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'photo'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'phone'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email'         => new sfValidatorEmail(array(),array('invalid'=>'<em>Introduce un E-mail válido</em>', 'required' => '<em>Este campo es obligatorio</em>')),
      're_email'      => new sfValidatorString(array('max_length' => 100, 'required' => false), array('required' => '<em>Este campo es obligatorio</em>','max_length'=>'<em>E-mail no valido</em>')),
      'password'      => new sfValidatorString(array('max_length' => 100, 'required' => false), array('required' => '<em>Este campo es obligatorio</em>','max_length'=>'<em>Contraseña no valida</em>')),
      're_password'   => new sfValidatorString(array('max_length' => 100, 'required' => false), array('required' => '<em>Este campo es obligatorio</em>','max_length'=>'<em>Contraseña no valida</em>')),
    ));

    // validator for user login
    $compare = $values['email'] == $this->getObject()->getEmail()?sfValidatorSchemaCompare::NOT_EQUAL:sfValidatorSchemaCompare::EQUAL;
    $v = new sfValidatorSchemaCompare('email', $compare, 're_email', array(), array('invalid' =>'<em>Los E-mails no son iguales</em>'));
    if($user_name && $this->getObject()->isNew())
    {
        $v = new sfValidatorSchemaCompare('email', sfValidatorSchemaCompare::EQUAL, $user_name, array(), array('invalid'=>'<em>El E-mail ya está registrado</em>'));
    }

    $this->validatorSchema->setPostValidator(
       new sfValidatorAnd(
       array($v,
             new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 're_password', array(), array('invalid' => '<em> Las contraseñas no son iguales</em>'))
       )));

    $this->widgetSchema->setNameFormat('app_user[%s]');
  }

}