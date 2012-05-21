<?php
	$str_module = $sf_params->get('module');
	$str_action = $sf_params->get('action');
	$request_id = $id ?  "?id=$id" : '';
?>
<div class="content">
	<div class="rightside">
		<div class="paneles" style="text-align:center;">
			<img src="/admin/<?php echo $photo ? 'uploads/user/'.$photo : 'images/no_user_b.jpg' ?>" border="0"/>
		</div>
	</div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('salesman/index') ?>"><strong><?php echo __('Salesmen') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __(ucfirst($str_action)) ?>
		</div>
		<?php if ($form->hasErrors() || count($error) > 0): ?>
			<div class="mensajeSistema error">
				<ul>
					<?php foreach ($error as $e): ?><li><?php echo __($e, NULL, 'errors') ?></li><?php endforeach; ?>
					<?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError() && $formField->getName() != 'email') { echo '<li>'.$formField->getError().'</li>'; } } ?>
				</ul>
			</div>
		<?php endif; ?>
		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Salesman') ?>
		</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for($str_module.'/'.$str_action).$request_id ?>">
			<label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="11%"><label><?php echo __('Email') ?> *</label></td>
						<td width="89%"><input type="text" class="form_input" name="email" value="<?php echo $email ?>" style="width:330px;"/></td>
					</tr>
					<tr>
						<td><label><?php echo __('Name') ?> *</label></td>
						<td><?php echo $form['name'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Last name') ?> *</label></td>
						<td><?php echo $form['last_name'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Photo') ?></label></td>
						<td valign="middle">
							<input type="file" name="photo" class="form_input"/>
							<?php if ($photo): ?>
								<input type="checkbox" name="reset_photo" style="vertical-align:middle;margin-left:10px;"/>&nbsp;<label><?php echo __('Check to delete') ?></label>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td><label><?php echo __('Enabled') ?></label></td>
						<td><?php echo $form['enabled'] ?></td>
					</tr>
				</table>
			</fieldset>
			<fieldset style="margin-top:10px;">
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<?php
						$fixed_label = 'Password';
						$fixed_asterisk = '&nbsp;*';

						if ($id):
							$fixed_label = 'New password';
							$fixed_asterisk = '';
					?>
						<tr><td><label><?php echo __('Password') ?></label></td><td>***************</td></tr>
					<?php endif; ?>
					<tr>
						<td width="15%"><label><?php echo __($fixed_label).$fixed_asterisk ?></label></td>
						<td width="85%"><input type="password" name="password" class="form_input" style="width:200px;"></td>
					</tr>
					<tr>
						<td><label><?php echo __('Repeat password').$fixed_asterisk ?></label></td>
						<td><input type="password" name="repeat_password" class="form_input" style="width:200px;"></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:right;"><em style="font-size:10px;"><?php echo __('Password correct format') ?></em></td>
					</tr>
				</table>
			</fieldset>
			<div style="padding-top:10px;" class="botonera">
				<input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
				<input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action" />
				<?php echo $form->renderHiddenFields() ?>
			</div>
		</form>
	</div>
	<div class="clear"></div>
</div>