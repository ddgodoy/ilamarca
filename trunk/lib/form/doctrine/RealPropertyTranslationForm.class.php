<?php

/**
 * RealPropertyTranslation form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RealPropertyTranslationForm extends BaseRealPropertyTranslationForm
{
  public function configure()
  {
  	$this->setWidgets(array(
      'detail' => new sfWidgetFormTextarea(array(), array('class'=>'form_input', 'style'=>'width:600px;height:100px;')),
    ));

    $this->setValidators(array(
      'detail' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('real_property_translation[%s]');
  }

} // end class