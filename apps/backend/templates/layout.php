<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo __('Web Administration') ?></title>
  <link rel="shortcut icon" href="/favicon.ico" />
  <?php include_stylesheets() ?>
  <?php include_javascripts() ?>
</head>
<body>
	<div class="head">
		<div class="up_bar">
			<!--<div class="links"><a href="#"><span>new option</span></a></div>-->
			<div class="grl">
				<a href="<?php echo url_for('home/index') ?>" class="home"><?php echo __('Home') ?></a>
				<a href="<?php echo url_for('home/myProfile') ?>" class="datos"><?php echo __('My profile') ?></a>
				<a href="<?php echo url_for('home/logout') ?>" class="cerrar" style="margin-left:20px;">
					<?php echo __('Close session') ?>
				</a>
			</div>
		</div>
		<div class="logo">
			<?php
				$_company_logo = 'images/no_company_logo.png';
				$_fixSize_logo = 'width="200"';
				
				if ($sf_user->getAttribute('user_company_logo')) {
					$_company_logo = 'uploads/company/'.$sf_user->getAttribute('user_company_logo');
					$_fixSize_logo = '';
				}
			?>
			<img src="/admin/<?php echo $_company_logo ?>" title="<?php echo $sf_user->getAttribute('user_company_name') ?>" <?php echo $_fixSize_logo ?>/>
		</div>
		<div class="user">
			<a href="<?php echo url_for('home/myProfile') ?>">
				<img src="/admin/<?php echo $sf_user->getAttribute('user_photo') ? 'uploads/user/'.ServiceFileHandler::getThumbImage($sf_user->getAttribute('user_photo')) : 'images/no_user.jpg' ?>" width="20" height="20" alt="User" border="0"/>
			</a>
			<strong><?php echo $sf_user->getAttribute('user_name') ?></strong>
		</div>
		<div class="basics_links"><!--<a href="#"><?php //echo __('Help') ?></a>--></div>
		<div class="menu"><?php include_partial('home/menu') ?></div>
	</div>
	<?php echo $sf_content ?>
	<div class="foot">
		<span class="copy">&copy; Copyright, Icox <?php echo date('Y') ?> - <?php echo __('All rights reserved') ?></span>
		<div class="buttons">
			<!--<a href="#" class="noti">Notificaciones</a><a href="#" class="mail">Correo</a>-->
		</div>
	</div>
</body>
</html>