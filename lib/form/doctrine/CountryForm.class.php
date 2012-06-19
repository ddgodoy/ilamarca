<?php

/**
 * Country form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CountryForm extends BaseCountryForm
{
  public function configure()
  {
  	$i18N = sfContext::getInstance()->getI18N();

  	$this->setWidgets(array(
      'name' => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:330px;')),
    ));

    $this->setValidators(array(
      'name' => new sfValidatorString(array('max_length' => 100), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
    ));

    $this->widgetSchema->setNameFormat('country[%s]');
  }

} // end class