<div class="content">
	<div class="leftside">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('neighborhood/index') ?>"><strong><?php echo __('Neighborhoods') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __('Detail') ?>
		</div>
		<h1 class="titulos"><?php echo __('Updated record') ?></h1><br />
		<fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
				<tr>
					<td width="10%"><label><strong><?php echo __('Geo zone') ?>&nbsp;:&nbsp;</strong></label></td>
					<td width="90%" class="text_detail"><?php echo $oValue->City->GeoZone->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('City') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->City->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Name') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getName() ?></td>
				</tr>
			</table>
		</fieldset>
		<div style="padding-top:10px;" class="botonera">
			<input type="button" onclick="document.location='<?php echo url_for('neighborhood/edit').'?id='.$id ?>';" value="<?php echo __('Edit') ?>" class="boton" />
			<input type="button" onclick="document.location='<?php echo url_for('neighborhood/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>