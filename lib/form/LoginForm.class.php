<?php

/**
 * Login form
 *
 * @package    muevetumovil
 * @author     Keyvan Akbary <keyvan@samarcoweb.com>
 */
class LoginForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
        'email' => new sfWidgetFormInput(),
        'password' => new sfWidgetFormInput(array('type' => 'password'))
    ));

    $this->setValidators(array(
        'email' => new sfValidatorString(),
        'password' => new sfValidatorString()
    ));

    $this->validatorSchema->setPostValidator(new ValidatorUser());

    $this->widgetSchema->setNameFormat('login[%s]');
  }

} // end class