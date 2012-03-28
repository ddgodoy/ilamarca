<div class="content">
	<div class="rightside">
		<div class="paneles" style="text-align:center;">
			<img src="/admin/<?php echo $oValue->getLogo() ? 'uploads/company/'.$oValue->getLogo() : 'images/no_company_logo.jpg' ?>" border="0"/>
		</div>
	</div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('company/index') ?>"><strong><?php echo __('Companies') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __('Detail') ?>
		</div>
		<h1 class="titulos"><?php echo __('Updated record') ?></h1><br />
		<fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
				<tr>
					<td width="10%"><label><strong><?php echo __('Name') ?>&nbsp;:&nbsp;</strong></label></td>
					<td width="90%" class="text_detail"><?php echo $oValue->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Email') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getEmail() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Address') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getAddress() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Phone') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getPhone() ?></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>&nbsp;POP3&nbsp;</legend>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
				<tr>
					<td width="10%"><label><strong><?php echo __('Host') ?>&nbsp;:&nbsp;</strong></label></td>
					<td width="90%" class="text_detail"><?php echo $oValue->getPop3Host() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('User') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getPop3User() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Password') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getPop3Password() ?></td>
				</tr>
			</table>
		</fieldset>
		<div style="padding-top:10px;" class="botonera">
			<input type="button" onclick="document.location='<?php echo url_for('company/edit').'?id='.$id ?>';" value="<?php echo __('Edit') ?>" class="boton" />
			<input type="button" onclick="document.location='<?php echo url_for('company/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>