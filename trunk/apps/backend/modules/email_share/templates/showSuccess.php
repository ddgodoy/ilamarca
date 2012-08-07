<div class="content">
	<div class="leftside">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('email_share/index') ?>"><strong><?php echo __('Emails') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __('Detail') ?>
		</div>
		<h1 class="titulos">Detalle del registro &quot;enviar a un amigo&quot;</h1><br />
		<fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
				<tr>
					<td width="7%"><label><strong><?php echo __('Fecha') ?>&nbsp;:&nbsp;</strong></label></td>
					<td width="93%" class="text_detail"><?php echo Common::getFormattedDate($oValue->getCreatedAt(), 'd/m/Y H:i') ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Name') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong>Email&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getEmail() ?></td>
				</tr>
				<tr>
					<td><label><strong>Email amigo&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getEmailFriend() ?></td>
				</tr>
				<tr>
					<td valign="top"><label><strong>Comentarios&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo nl2br($oValue->getComment()) ?></td>
				</tr>
				<tr>
					<td valign="top"><label><strong>Url&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getUrl() ?></td>
				</tr>
			</table>
		</fieldset>
		<div style="padding-top:10px;" class="botonera">
			<input type="button" onclick="document.location='<?php echo url_for('email_share/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>