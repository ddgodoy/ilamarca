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

    $culture = $culture=='ar' ? 'es' : $culture;
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
        $this->type  = $request->getParameter('type','');
        $this->label =  $this->type != ''?'Propiedad':'Consulta';
        $this->perfil = $request->getParameter('perfil','');
        $dir_name_file = FALSE;
        if($this->perfil!='')
        {
          $this->label = 'Descripción';
        }
	$this->form  = new ContacForm();
        $redirect = 'home/contact';

        if ($request->isMethod('POST'))
        {
			$this->form->bind($request->getParameter($this->form->getName()));

            if ($this->form->isValid())
            {
                $file = $request->getFiles('cv', '');
				$post_values = $this->form->getValues();
                $post_values['type'];

                if(!empty ($file))
                {
                    if($file['type']!='application/pdf' && $file['type']!='application/msword')
                    {
                      $this->error_file = true;
                    }
                    else
                    {
                      $uploadDir = sfConfig::get('sf_upload_dir') . '/assets';
                      $dir_name_file = $uploadDir . "/" . $file["name"];
                      move_uploaded_file($file["tmp_name"],  $dir_name_file);
                      $redirect = 'home/contact?perfil=comunidad';
                      $post_values['type'] = 'perfil';
                      $post_values['address'] = '---';
                    }
                }
                if(empty($this->error_file))
                {
                  switch ($post_values['type'])
                  {
                    case 'alquila': $subject = 'Nueva consulta por Alquiler de propiedad'; break;
                    case 'vende': $subject = 'Nueva consulta por Venta de propiedad'; break;
                    case 'perfil': $subject = 'Envío de CV para pertenecer a la comunidad '; break;
                    default:
                      $subject = 'Nueva consulta desde '.sfConfig::get('app_project_url_name');
                  }

                  //$destinatarios = array('matias@ilamarca.com'=>'Matías', 'luciana@ilamarca.com'=>'Luciana');
                  $destinatarios = array('mauro@icox.com'=>'Mauro',);
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
                      ),$dir_name_file
                  );
                      $this->getUSer()->setFlash('notice', true);
                      $this->redirect($redirect);
               }
           }
        }
  }

} // end class