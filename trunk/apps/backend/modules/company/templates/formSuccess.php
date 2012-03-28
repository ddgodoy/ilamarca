<?php
	$str_module = $sf_params->get('module');
	$str_action = $sf_params->get('action');
	$request_id = $id ?  "?id=$id" : '';
?>
<div class="content">
	<div class="rightside">
		<div class="paneles" style="text-align:center;">
			<img src="/admin/<?php echo $logo ? 'uploads/company/'.$logo : 'images/no_company_logo.jpg' ?>" border="0"/>
		</div>
	</div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('company/index') ?>"><strong><?php echo __('Companies') ?></strong></a>
			&nbsp;&gt;&nbsp;<?php echo __(ucfirst($str_action)); ?>
		</div>
		<?php if ($form->hasErrors()): ?>
			<div class="mensajeSistema error">
				<ul><?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$formField->getError().'</li>'; } } ?></ul>
			</div>
		<?php endif; ?>
		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Company') ?>
		</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for($str_module.'/'.$str_action).$request_id ?>">
			<label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="10%"><label><?php echo __('Name') ?> *</label></td>
						<td width="90%"><?php echo $form['name'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Email') ?></label></td>
						<td><?php echo $form['email'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Address') ?></label></td>
						<td><?php echo $form['address'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Phone') ?></label></td>
						<td><?php echo $form['phone'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Logo') ?></label></td>
						<td valign="middle">
							<input type="file" name="logo" class="form_input"/>
							<?php if ($logo): ?>
								<input type="checkbox" name="reset_logo" style="vertical-align:middle;margin-left:10px;"/>&nbsp;<label><?php echo __('Check to delete') ?></label>
							<?php endif; ?>
						</td>
					</tr>
				</table>
			</fieldset>
			<fieldset>
				<legend>&nbsp;POP3&nbsp;</legend>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="10%"><label><?php echo __('Host') ?></label></td>
						<td width="90%"><?php echo $form['pop3_host'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('User') ?></label></td>
						<td><?php echo $form['pop3_user'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Password') ?></label></td>
						<td><?php echo $form['pop3_password'] ?></td>
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