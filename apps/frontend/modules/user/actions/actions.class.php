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
        	'subject'    => 'Sus datos de acceso para '.sfConfig::get('app_project_url_name'),
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

       $this->redirect('@profile');
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
   * View profile
   * 
   * @param sfWebRequest $request
   */
  public function executeProfile(sfWebRequest $request)
  {
    $this->oUser = AppUserTable::getInstance()->find($this->getUser()->getAttribute('user_id'));
    $this->searchs = SearchProfileTable::getInstance()->getSearchsForThisUser($this->oUser->getId());
  }

  /**
   * Update profile values
   * 
   * @param sfWebRequest $request
   */
  public function executeUpdateProfile(sfWebRequest $request)
  {
    $_user = $this->getUser()->getAttribute('user_id', '');

    if ($_user== '') {
      $this->redirect('@homepage');
    }
    $_user_object = AppUserTable::getInstance()->findOneById($_user);
    $_pass = $_user_object->getPassword();
    $_salt = $_user_object->getSalt();

    $this->form = new AppUserProfileForm($_user_object);

    if ($request->isMethod('POST')) {
      $this->processFormUpdateProfile($request, $this->form, $_pass, $_salt);
    }
  }
	//
  protected function processFormUpdateProfile(sfWebRequest $request, sfForm $form, $_pass, $_salt)
  {
    $form->bind($request->getParameter($form->getName()),$request->getFiles($form->getName()));
    $photo_user = $this->getUser()->getAttribute('user_photo');

    if ($form->isValid())
    {
       $photo = $request->getFiles($form->getName());
       $value = $form->getValues();
       $profile = $form->save();

       if ($photo['photo']['size'] <= 0) {
         $profile->setPhoto($photo_user);
       }
       if ($value['password']=='') {
          $profile->setPasswordOffSalt($_pass);
          $profile->setSalt($_salt);
       } else {
         $profile->setPassword($value['password']);
       }
       $profile->save();

       ## set photo
  	   AppUserTable::getInstance()->uploadPhoto($photo['photo'], $profile);

       ServiceAuthentication::startSessionProcess($profile);

       $this->getUser()->setFlash('notice', 'Sus datos fueron modificados con exito');

       $this->redirect('@profile');
    }
  }

} // end class