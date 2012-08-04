<?php

/**
 * home actions.
 *
 * @package    ilamarca
 * @subpackage home
 * @author     pinika
 * @version    1
 */
class homeActions extends sfActions
{
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->db_properties = PropertyTypeTable::getInstance()->getAllForSelect(true, 'Property type');
    $this->db_operations = OperationTable::getInstance()->getAllForSelect(true, 'Operation');
    $this->db_geo_zones  = GeoZoneTable::getInstance()->getAllForSelect(true, 'Place');
    $this->db_bedrooms   = BedroomTable::getInstance()->getAllForSelect(true, 'Bedrooms');
    $this->db_currencies = CurrencyTable::getInstance()->getAllForSelect();
  }

  /**
   * set culture
   * @param sfWebRequest $request
   */
  public function executeSetCulture(sfWebRequest $request)
  {
    $culture = $request->getParameter('country', 'ar');

    $this->getUser()->setAttribute('true_culture', $culture);
    
    $culture = $culture=='ar'?'es':$culture;

    $culture = $request->getPreferredCulture(array($culture));
    $this->getUser()->setCulture($culture);
    
    $this->redirect('@homepage');
  }

  /**
   * Executes contact action
   *
   * @param sfRequest $request A request object
   */
	public function executeContact(sfWebRequest $request)
	{
        $this->type = $request->getParameter('type','');
		$this->form = new ContacForm();
		
		if ($request->isMethod('POST'))
		{
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid())
			{
				$post_values = $this->form->getValues();

                $post_values['type'];

                switch ($post_values['type']) {
                  case 'alquila':
                      $subject = 'Nueva consulta por Alquiler de propiedad';
                    break;
                  case 'vende':
                      $subject = 'Nueva consulta por Venta de propiedad';
                    break;
                  default:
                      $subject = 'Nueva consulta desde '.sfConfig::get('app_project_url_name');
                    break;
                }

				//
				$destinatarios = array('matias@inmobiliarialamarca.com'=>'Matías', 'luciana@inmobiliarialamarca.com'=>'Luciana');
				//
				$sendEmail = ServiceOutgoingMessages::sendToMultipleAccounts($destinatarios, 'home/mailFromUser',
		  		array(
		  			'subject'     => $subject,
		  			'to_partial'  => array(
		  				'nombre'    => $post_values['name'],
		  				'email'     => $post_values['email'],
		  				'telefono'  => $post_values['phone'],
		  				'direccion' => $post_values['address'],
		  				'consulta'  => $post_values['message']
		  			)
		  		)
		  	);
				$this->getUSer()->setFlash('notice', true);
				$this->redirect('home/contact');
			}
		}
	}

} // end class