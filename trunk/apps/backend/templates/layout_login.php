<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo __('Web Administration') ?></title>
  <link rel="shortcut icon" href="/favicon.ico" />
  <link href="/admin/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="head login">
		<img class="logo" src="/admin/images/login_logo.png" alt="Home" style="margin-top:90px;" />
	</div>
	<?php echo $sf_content ?>
	<div class="foot">
		<span class="copy">&copy; Copyright, Icox <?php echo date('Y'); ?> - <?php echo __('All rights reserved') ?></span>
		<div class="buttons">
			<!--<select>
				<option value="0"><?php echo __('Language') ?></option>
				<option value="es"><?php echo __('Spanish') ?></option>
				<option value="en"><?php echo __('English') ?></option>
			</select>-->
		</div>
	</div>
</body>
</html>