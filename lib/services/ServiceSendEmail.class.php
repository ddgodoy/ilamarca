<?php
/**
 * ServiceSendEmailClass
 *
 * @author mauro
 */
class ServiceSendEmail
{
	public static function sendEmailForContact($form)
	{
		
		/*
		sfProjectConfiguration::getActive()->loadHelpers(array("Partial", "Url"));

		$mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());
		$pRef = sfConfig::get('app_project_reference_name');
		$i18N = sfContext::getInstance()->getI18N();
		
		//$mailBody = get_partial('authentication/forgotenMailToUser', array('project'=>$pRef, 'user'=>$user_name, 'url'=>$sUrl));
		
		$mailBody = '<b>hola que tal</b>';
		$message = Swift_Message::newInstance($pRef.' - '.$i18N->__('Nuevo email de contacto'))
							->setFrom(array(sfConfig::get('app_no_replay_email_account') => $pRef))
							->setTo(array($form['email'] => $form['name']))
							->setBody($mailBody, 'text/html');

		return $mailer->send($message);
		*/
	}

} // end class