<?php

/**
 * User validator
 *
 * @package    user
 * @author     mauro garcia
 */
class ValidatorUser extends sfValidatorBase
{
    /**
     * Validator configuration
     *
     * Available options:
     *
     *  * username_field      Username field name (default email)
     *  * password_field      Password field name (default password)
     *  * throw_global_error  Throw an Exception if global is true
     *
     * @see sfValidatorBase
     */
    public function configure($options = array(), $messages = array())
    {
        $this->addOption('username_field', 'email');
        $this->addOption('password_field', 'password');
        $this->addOption('throw_global_error', false);

        $this->setMessage('invalid', 'The username and/or password is invalid.');
    }

    /**
     * @see sfValidatorBase
     */
    protected function doClean($values)
    {
        //Only validate if username and password are both present
        if (isset($values[$this->getOption('username_field')]) && isset($values[$this->getOption('password_field')]))
        {
            $username = $values[$this->getOption('username_field')];
            $password = $values[$this->getOption('password_field')];

            //Check the user existence
            if ($user = AppUserTable::getInstance()->findOneByEmail(strtolower($username)))
            {
                //Check the password
                if ($user->checkPassword($password))
                {
                    return array_merge($values, array('user' => $user));
                }
            }

            if ($this->getOption('throw_global_error'))
            {
                throw new sfValidatorError($this, 'invalid');
            }

            throw new sfValidatorErrorSchema($this, array(
                $this->getOption('username_field') => new sfValidatorError($this, 'invalid'),
            ));
        }

        return $values;
    }
}