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
	function fillSimpleSelect($options, $selected = 0)
	{
		$tag_options = '';

		foreach ($options as $key => $value) {
			$style_selected = $key == $selected ? ' selected' : '';

			$tag_options .= "<option value='$key'$style_selected>$value</option>\n";
		}		
		return $tag_options;
	}

} // end class