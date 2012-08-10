<?php

class myUser extends sfBasicSecurityUser
{
	/**
	 * Add searc data to uesr session
	 *
	 * @param string $rq_method
	 * @param array $params
	 * @param string $filter
	 */
	public static function recSearchInSession($rq_method, $params, $filter)
	{
		$sUser = sfContext::getInstance()->getUser();
		
		if ($sUser->isAuthenticated() && $rq_method == 'POST')
		{
			$sUser->setAttribute("sch_filter", $filter);

			foreach ($params as $k => $param) {
				if ($k != 'module' && $k != 'action') {
					$sUser->setAttribute("sch_$k", $param);
				}
			}
		}
	}
	
	/**
	 * Clear session values for search
	 */
	public static function clearSearchInSession()
	{
		$holder = sfContext::getInstance()->getUser()->getAttributeHolder();

		$holder->remove('sch_filter');
		$holder->remove('sch_bedroom');
		$holder->remove('sch_property_type');
		$holder->remove('sch_operation');
		$holder->remove('sch_geo_zone');
		$holder->remove('sch_city');
		$holder->remove('sch_neighborhood');
		$holder->remove('sch_currency');
		$holder->remove('sch_p_from');
		$holder->remove('sch_p_to');
	}
	
	/**
	 * Automatic notification to vendors on search_match
	 *
	 * @param array $vendors
	 * @param string $host
	 */
	public static function notifyVendorsOnSearchMatch($vendors, $host)
	{
		if (count($vendors) > 0)
		{
			$mail_titulo = 'Aviso de usuario buscando propiedades en '.sfConfig::get('app_project_url_name');

			foreach ($vendors as $val) {
				$a_datos = explode('?', $val);
				$to_send[$a_datos[0]] = $a_datos[1];
			}
			ServiceOutgoingMessages::sendToMultipleAccounts(
				$to_send,
				'search/notifyVendors',
				array(
	  			'subject'     => $mail_titulo,
	  			'to_partial'  => array(
	  				'titulo'    => $mail_titulo,
	  				'url_sitio' => sfConfig::get('app_project_url_name'),
	  				'backend'   => 'http://'.$host.'/admin'
	  			)
	  		)
			);
		}
	}

} // end class