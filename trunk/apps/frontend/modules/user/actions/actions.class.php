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
            $user->setNewRecoverToken();
            $user->save();

            ServiceOutgoingMessages::sendToSingleAccount($value['name'].', '.$value['last_name'],
                                                         $value['email'],
                                                         'home/mailUserFrontend',
                                                         array('subject'     => 'Sus datos de acceso para ilamarca.com',
                                                               'to_partial'  => array(
                                                                      'email'     => $value['email'],
                                                                      'token'  => $user->getRecoverToken()
                                                              )
                                                         ));
            $this->getUser()->setFlash('notice', true);
            $this->redirect('user/index');
        }
    }

    public function executeLoging(sfWebRequest $request)
    {
        $this->form = new LoginForm();

    }


}