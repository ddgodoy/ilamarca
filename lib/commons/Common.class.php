<?php

/**
 * Common functions
 */
class Common
{
	/**
	 * Check email
	 *
	 * @param string $email
	 * @return string
	 */
	public static function getEmailError($email)
	{
		$st_error = '';
		$validate = new sfValidatorEmail(array('required'=>true), array('required'=>'Enter the email', 'invalid'=>'The email seems incorrect'));

  	try { $validate->clean($email); } catch(sfValidatorError $e) { $st_error = $e; }

  	return $st_error;
	}
	
	/**
	 * Check password
	 *
	 * @param string $password
	 * @return string
	 */
	public static function getPasswordError($password)
	{
		$st_error = '';
		$validate = new sfValidatorAnd(
			array(
				new sfValidatorRegex(array('pattern' => "((?=.*\d)(?=.*[a-zA-Z]).)")),
				new sfValidatorString(array('min_length' => 6))
    	), array('required'=>true), array('required'=>'Enter the password', 'invalid'=>'The password seems incorrect')
    );
  	try { $validate->clean($password); } catch(sfValidatorError $e) { $st_error = $e; }

  	return $st_error;
	}

	/**
	 * Render options for simple select tag
	 *
	 * @param array $options
	 * @param mixed $selected
	 * @return string
	 */
	public static function fillSimpleSelect($options, $selected = 0)
	{
		$tag_options = '';

		foreach ($options as $key => $value) {
			$style_selected = $key == $selected ? ' selected' : '';

			$tag_options .= "<option value='$key'$style_selected>$value</option>\n";
		}		
		return $tag_options;
	}
	
	/**
	 * Render options for multiple select tag with checkboxes
	 *
	 * @param string $objeto
	 * @param array $datos
	 * @param array $seleccionados
	 * @param integer $altura_div
	 * @return string
	 */
	public static function fillMultipleSelectWithBoxes($objeto, $datos, $seleccionados = array(), $altura_div = 158)
	{
		$Opciones = "<div class='d_2' style='height:$altura_div;'>";

		foreach($datos as $indice => $valor)
		{
			$elegida = "";
			$bgcolor = "#E5E5E5";
			$frcolor = "#333333";

			foreach ($seleccionados as $selected) {
				if ($indice == $selected) {
					$elegida = " CHECKED "; $bgcolor = "#F1DCB4"; break;
				}
			}
			$Opciones .= "<label style='display:block;background-color:$bgcolor;color:$frcolor;'>";
			$Opciones .= "<input name='$objeto' value='$indice' type='checkbox' $elegida onclick='highlight_div(this);' style='vertical-align:middle;'>";
			$Opciones .= "&nbsp;$valor</label>\n";
		}
		return $Opciones."</div>";
	}

} // end class