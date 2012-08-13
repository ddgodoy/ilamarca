<?php

class myUser extends sfBasicSecurityUser
{
	/**
	 * Automatic notification to customers on real_property registration
	 *
	 * @param boolean $go
	 * @param integer $real_property_id
	 * @param string $hostname
	 */
	public static function notifyCustomersAboutThis($go, $real_property_id, $hostname)
	{
		if ($go) {
			$customers = SearchMatchTable::getInstance()->matchThisPropertyAndCustomersSearch($real_property_id);
			
			if (count($customers) > 0) {
				$mail_titulo = 'Una nueva propiedad en ilamarca coincide con tu búsqueda';
				
				ServiceOutgoingMessages::sendToMultipleAccounts(
					$customers,
					'property/notifyCustomers',
					array(
		  			'subject'   => $mail_titulo,
		  			'to_partial'=> array(
		  				'titulo'  => $mail_titulo,
		  				'sitio'   => sfConfig::get('app_project_url_name'),
		  				'go_to'   => 'http://'.$hostname.'/property?id='.$real_property_id
		  			)
		  		)
				);
			}
		}
	}
	
} // end class