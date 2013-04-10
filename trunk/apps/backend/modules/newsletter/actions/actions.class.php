<?php

/**
 * newsletter actions.
 *
 * @package    sf_icox
 * @subpackage newsletter
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsletterActions extends sfActions
{
 /**
  * Executes add to cart action
  *
  * @param sfRequest $request A request object
  */
  public function executeAddToCart(sfWebRequest $request)
  {
  	$property_id = trim($request->getParameter('property_id', 0));

  	$sUser   = sfContext::getInstance()->getUser();
    $content = $sUser->getAttribute('properties_in_cart', array());
    
    if (!empty($property_id))
    {
    	$content[$property_id] = $property_id;

  		$sUser->setAttribute('properties_in_cart', $content);
    }
  	return $this->renderText(count($content)); exit();
  }
  
  /**
  * Executes cart list action
  *
  * @param sfRequest $request A request object
  */
  public function executeCartList(sfWebRequest $request)
  {
  	$this->lista = RealProperty::getListForNewsletter();
  	
  	if (count($this->lista) == 0) {
  		$this->redirect('property/index');
  	}
  }
  
  /**
   * Executes delete action
   *
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
  	$sUser = sfContext::getInstance()->getUser();
  	$id = $request->getParameter('id');
		$content = $sUser->getAttribute('properties_in_cart', array());
		
		if (isset($content[$id])) {
			unset($content[$id]);

			// update cart
			$sUser->setAttribute('properties_in_cart', $content);
		}
  	$this->redirect('newsletter/cartList');
  }
  
  /**
   * Executes clean newsletter action
   *
   * @param sfWebRequest $request
   */
  public function executeClean(sfWebRequest $request)
  {
  	sfContext::getInstance()->getUser()->setAttribute('properties_in_cart', array());
  	
  	$this->redirect('property/index');
  }
  
  /**
   * Executes build newsletter action
   *
   * @param sfWebRequest $request
   */
  public function executeBuilder(sfWebRequest $request)
  {
  	$this->_temp = array();
  	$this->lista = array();
  	$this->xhost = $request->getHost();

  	$obLista = RealProperty::getListForNewsletter();
  	
  	foreach ($obLista as $olista)
  	{
  		$this->_temp[] = array(
  			'id'      =>$olista->getId(),
  			'name'    =>$olista->getName(),
  			'address' =>$olista->getAddress(),
  			'area'    =>$olista->getCoveredArea(),
  			'square'  =>$olista->getSquareMeters(),
  			'detail'  =>$olista->getDetail()
  		);
  	}
  	if (count($this->_temp) > 0) {
  		$this->lista = array_chunk($this->_temp, 2);
  	}
  	$this->setLayout('layout_newsletter');
  }

} // end class