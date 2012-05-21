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
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid())
        {
            
        }
    }


}