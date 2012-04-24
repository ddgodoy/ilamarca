<?php

/**
 * search actions.
 *
 * @package    ilamarca
 * @subpackage search
 * @author     pinika
 * @version    1
 */
class searchActions extends sfActions
{
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
        $this->p_desde       = $this->getRequestParameter('p_from', 0);
        $this->p_hasta       = $this->getRequestParameter('p_to', 0);
        $this->currency      = $this->getRequestParameter('currency', 0);
        $str_module          = $request->getParameter('module');
        $this->index_url     = sfContext::getInstance()->getController()->genUrl($str_module.'/index');

        $array_data_currency = array('currency'=>$this->currency, 'p_desde'=>$this->p_desde, 'p_hasta'=>$this->p_hasta);

  	$this->iPage  = $request->getParameter('page', 1);
  	$this->oPager = RealPropertyTable::getInstance()->searchResults($this->iPage, 1, $this->setFilter(),'',$array_data_currency);
  	$this->oList  = $this->oPager->getResults();
  }
  
  /**
   * Set filter
   *
   * @return string
   */
  protected function setFilter()
  {
  	$sch_partial = 'p.id > 0';
  	$this->f_params = '';
        $this->pager_order = '';

  	$this->property_type = $this->getRequestParameter('property_type', 0);
        $this->operation     = $this->getRequestParameter('operation', 0);
        $this->geo_zone      = $this->getRequestParameter('geo_zone', 0);
        $this->city          = $this->getRequestParameter('property_type', 0);
        $this->neighborhood  = $this->getRequestParameter('neighborhood', 0);
        $this->bedroom       = $this->getRequestParameter('bedroom', 0);

        if (!empty($this->property_type)) {
                $sch_partial .= " AND p.property_type_id = $this->property_type";
                $this->f_params .= '&property_type='.$this->property_type;
        }
        if (!empty($this->geo_zone)) {
                $sch_partial .= " AND p.geo_zone_id = $this->geo_zone";
                $this->f_params .= '&geo_zone='.$this->geo_zone;
        }
        if (!empty($this->city)) {
                $sch_partial .= " AND p.city_id = $this->city";
                $this->f_params .= '&city='.$this->city;
        }
        if (!empty($this->neighborhood)) {
                $sch_partial .= " AND p.neighborhood_id = $this->neighborhood";
                $this->f_params .= '&neighborhood='.$this->neighborhood;
        }
        if (!empty($this->bedroom)) {
                $sch_partial .= " AND p.bedroom_id = $this->bedroom";
                $this->f_params .= '&bedroom='.$this->bedroom;
        }
        return $sch_partial;
  }

} // end class