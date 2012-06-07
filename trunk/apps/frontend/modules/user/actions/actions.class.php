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
  /**
   * Index action
   * 
   * @param sfWebRequest $request
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new AppUserForm();

    if ($request->isMethod('POST')) {
      $this->processForm($request, $this->form);
    }
  }

  /**
   * process form
   * @param sfWebRequest $request
   * @param sfForm $form
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $captcha = array(
    	'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
	 		'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
		);
    $value = $request->getParameter($form->getName());
    $defaul = array('company_id'=>1,'user_role_id'=>2);
    $defaul_merge = $value+$defaul;

    $form->bind(array_merge($defaul_merge, array('captcha' => $captcha)));

    if ($form->isValid())
    {
      $user = $form->save();
      
      $user->setEnabled(0);
      $user->setPassword($value['password']);
      $user->setNewRecoverToken();
      $user->save();

      ServiceOutgoingMessages::sendToSingleAccount(
      	$value['name'].', '.$value['last_name'],
        $value['email'],
        'home/mailUserFrontend',
        array(
        	'subject'    => 'Sus datos de acceso para ilamarca.com',
          'to_partial' => array(
            'email' => $value['email'],
            'token' => $user->getRecoverToken()
          )
         )
      );
      $this->getUser()->setFlash('notice', true);
      $this->redirect('user/index');
    }
  }

  /**
   * Loging
   * 
   * @param sfWebRequest $request
   */
  public function executeLoging(sfWebRequest $request)
  {
    $this->form = new LoginForm();

    if ($request->isMethod('POST')) {
      $this->processFormLoging($request, $this->form);
    }
  }

  /**
   * Proccess form loging
   * 
   * @param sfWebRequest $request
   * @param sfForm $form
   */
  protected function processFormLoging(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));

    if ($form->isValid()) {
       $value = $form->getValues();
       ServiceAuthentication::startSessionProcess($value['user']);

       $this->redirect('home/index');
    }
  }

  /**
   * Executes logout action
   *
   * @param sfWebRequest $request
   */
  public function executeLogout(sfWebRequest $request)
  {
    ServiceAuthentication::closeSessionProcess();

    $this->redirect('home/index');
  }
  
  /**
   * Executes activate account action
   *
   * @param sfWebRequest $request
   */
  public function executeActivateAccount(sfWebRequest $request)
  {
    $tkn = trim($request->getParameter('tk', ''));
    $usr = AppUserTable::getInstance()->findOneByRecoverToken($tkn);

    if ($usr) {
    	if (!$usr->getEnabled()) {
	    	$usr->setRecoverToken(NULL);
	    	$usr->setEnabled(1);
	    	$usr->save();

	    	ServiceAuthentication::startSessionProcess($usr);
	
	    	$this->getUser()->setFlash('activate', true);	
    	}
    }
    $this->redirect('home/index');
  }

  /**
   * Execute Profile
   * @param sfWebRequest $request
   */
  public function executeProfile(sfWebRequest $request)
  {
    $this->form = new AppUserForm();
  }

} // end class