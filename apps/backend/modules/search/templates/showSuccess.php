<div class="content">
	<div class="leftside">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('search/index') ?>"><strong>Perfiles de búsqueda</strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __('Detail') ?>
		</div>
		<h1 class="titulos">Detalle del perfil &quot;<?php echo $oValue->getName() ?>&quot;</h1><br />
		<fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
				<tr>
					<td width="10%"><label><strong><?php echo __('Name') ?>&nbsp;:&nbsp;</strong></label></td>
					<td width="90%" class="text_detail"><?php echo $oValue->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong>Referencia&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getReference() ?></td>
				</tr>
				<tr>
					<td><label><strong>Tipo de propiedad&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->PropertyType->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong>Operación&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->Operation->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong>Lugar&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->GeoZone->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong>Localidad&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->City->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong>Barrio&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->Neighborhood->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong>Dormitorios&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->Bedroom->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong>Moneda&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->Currency->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong>Precio desde&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getMinPrice() ?></td>
				</tr>
				<tr>
					<td><label><strong>Precio hasta&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getMaxPrice() ?></td>
				</tr>
			</table>
		</fieldset>
		<div style="padding-top:10px;" class="botonera">
			<input type="button" onclick="document.location='<?php echo url_for('search/index') ?>';" value="Volver al listado" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>