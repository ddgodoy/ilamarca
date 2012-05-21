<?php

/**
 * user actions.
 *
 * @package    ilamarca
 * @subpackage user
 * @author     pinika
 * @version    1
 */
class userActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->form = new AppUserForm();
        if($request->isMethod('POST'))
        {
            $this->processForm($request, $this->form);
        }

    }
    
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $captcha = array('recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
			 'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
			);
        $value = $request->getParameter($form->getName());
        $defaul = array('company_id'=>1,'user_role_id'=>2);
        $defaul_merge = $value+$defaul;
        $form->bind(array_merge($defaul_merge, array('captcha' => $captcha)));
        if ($form->isValid())
        {
            $user = $form->save();

            $user->setPassword($value['password']);
            $user->setRecoverToken(sha1(MD5(uniqid(''))));
            $user->save();
        }
    }


}