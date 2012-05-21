<div class="content">
	<div class="rightside">
		<div class="paneles" style="text-align:center;">
			<img src="/admin/<?php echo $sf_user->getAttribute('user_photo') ? 'uploads/user/'.$sf_user->getAttribute('user_photo') : "images/no_user_b.jpg" ?>" width="150" height="150" border="0"/>
		</div>
	</div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo __('My profile') ?>
		</div>
		<?php if (count($my_error) > 0): ?>
			<div class="mensajeSistema error">
				<ul><?php foreach ($my_error as $error): ?><li><?php echo __($error, NULL, 'errors') ?></li><?php endforeach; ?></ul>
			</div>
		<?php endif; ?>
		<?php if ($my_go_ok): ?>
			<div class="mensajeSistema ok"><?php echo __('Profile updated successfully') ?></div>
		<?php endif; ?>
		<h1 class="titulos"><?php echo __('Update profile') ?></h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for('home/myProfile') ?>">
			<label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="12%"><label><?php echo __('Email') ?> *</label></td>
						<td width="88%" valign="middle"><input type="text" name="my_email" value="<?php echo $my_email ?>" class="form_input" style="width:330px;"></td>
					</tr>
					<tr>
						<td><label><?php echo __('Name') ?> *</label></td>
						<td valign="middle"><input type="text" name="my_name" value="<?php echo $my_name ?>" class="form_input" style="width:330px;"></td>
					</tr>
					<tr>
						<td><label><?php echo __('Last name') ?> *</label></td>
						<td valign="middle"><input type="text" name="my_last_name" value="<?php echo $my_lname ?>" class="form_input" style="width:330px;"></td>
					</tr>
					<tr>
						<td><label><?php echo __('Photo') ?></label></td>
						<td valign="middle">
							<input type="file" name="my_photo" class="form_input"/>
							<?php if ($sf_user->getAttribute('user_photo')): ?>
								<input type="checkbox" name="my_reset_photo" style="vertical-align:middle;margin-left:10px;"/>&nbsp;<label><?php echo __('Check to delete') ?></label>
							<?php endif; ?>
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td><label><?php echo __('Password') ?></label></td>
						<td valign="middle">***************</td>
					</tr>
					<tr>
						<td><label><?php echo __('New password') ?>&nbsp;(*)</label></td>
						<td valign="middle"><input type="password" name="my_password" class="form_input" style="width:200px;"></td>
					</tr>
					<tr>
						<td><label><?php echo __('Repeat password') ?></label></td>
						<td valign="middle"><input type="password" name="my_repeat_password" class="form_input" style="width:200px;"></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:right;"><em style="font-size:10px;"><?php echo __('Password correct format') ?></em></td>
					</tr>
				</table>
			</fieldset>
			<div style="padding-top:10px;" class="botonera">
				<input type="button" onclick="document.location='<?php echo url_for('home/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
				<input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action" />
			</div>
		</form>
	</div>
	<div class="clear"></div>
</div>