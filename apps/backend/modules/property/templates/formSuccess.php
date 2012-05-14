<?php
	$str_module = $sf_params->get('module');
	$str_action = $sf_params->get('action');
	$request_id = $id ?  "?id=$id" : '';
?>
<div class="content">
	<div class="leftside">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('property/index') ?>"><strong><?php echo __('Properties') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __(ucfirst($str_action)) ?>
		</div>
		<?php if (count($error) > 0): ?>
			<div class="mensajeSistema error">
				<ul><?php foreach ($error as $e): ?><li><?php echo __($e, NULL, 'errors') ?></li><?php endforeach; ?></ul>
			</div>
		<?php endif; ?>
		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Property') ?>
		</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for($str_module.'/'.$str_action).$request_id ?>">
			<label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label>
			<br />
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="10%" id="td_idioma_es" class="tab_idiomas_on" onclick="changeTabsOnclick('es');">Info en Español</td>
					<td width="10%" id="td_idioma_en" class="tab_idiomas_off" onclick="changeTabsOnclick('en');">Info en Inglés</td>
					<td width="80%">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3" class="tab_cont_borders">
						<div id="div_content_info_es" style="display:block;">
							<table cellpadding="0" cellspacing="0" style="padding:7px;">
								<tr>
									<td valign="top"><label>Nombre *</label></td><td width="22"></td>
									<td valign="top"><label>Descripción</label></td>
								</tr>
								<tr>
									<td valign="top">
										<table cellpadding="0" cellspacing="0">
											<tr><td><?php echo $form['es']['name']; echo $form['es']['name']->renderError(); ?></td></tr>
											<tr><td height="10"></td></tr>
											<tr><td><label>Dirección</label></td></tr>
											<tr><td><?php echo $form['es']['address'] ?></td></tr>
											<tr><td height="8"></td></tr>
											<tr><td><label>Transportes</label></td></tr>
											<tr><td><?php echo $form['es']['transports'] ?></td></tr>
										</table>
									</td><td width="22"></td>
									<td valign="top">
										<table cellpadding="0" cellspacing="0">
											<tr><td><?php echo $form['es']['detail'] ?></td></tr>
											<tr><td height="10"></td></tr>
											<tr><td><label>Puntos de referencia</label></td></tr>
											<tr><td><?php echo $form['es']['points_of_ref'] ?></td></tr>
										</table>
									</td>
								</tr>
							</table>
						</div>
						<div id="div_content_info_en" style="display:none;background-color:#FBFBFB;">
							<table cellpadding="0" cellspacing="0" style="padding:7px;">
								<tr>
									<td valign="top"><label>Nombre *</label></td><td width="22"></td>
									<td valign="top"><label>Descripción</label></td>
								</tr>
								<tr>
									<td valign="top">
										<table cellpadding="0" cellspacing="0">
											<tr><td><?php echo $form['en']['name'] ?></td></tr>
											<tr><td height="10"></td></tr>
											<tr><td><label>Dirección</label></td></tr>
											<tr><td><?php echo $form['en']['address'] ?></td></tr>
											<tr><td height="8"></td></tr>
											<tr><td><label>Transportes</label></td></tr>
											<tr><td><?php echo $form['en']['transports'] ?></td></tr>
										</table>
									</td><td width="22"></td>
									<td valign="top">
										<table cellpadding="0" cellspacing="0">
											<tr><td><?php echo $form['en']['detail'] ?></td></tr>
											<tr><td height="10"></td></tr>
											<tr><td><label>Puntos de referencia</label></td></tr>
											<tr><td><?php echo $form['en']['points_of_ref'] ?></td></tr>
										</table>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
			<fieldset style="margin-top:10px;padding-top:3px;">
				<legend>&nbsp;<?php echo __('Location') ?>&nbsp;</legend>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top">
							<table cellpadding="3" cellspacing="0">
								<tr>
									<td><label><?php echo __('Geo zone') ?></label></td>
									<td>
										<select name="geo_zone" class="form_input" style="width:300px;" onchange="updCityList(this.value);">
											<?php echo Common::fillSimpleSelect(GeoZoneTable::getInstance()->getAllForSelect(true), $geo_zone) ?>
										</select>
									</td>
									<td><img src="/admin/images/loader.gif" id="img_loading_cities" border="0" style="visibility:hidden;"/></td>
								</tr>
								<tr>
									<td><label><?php echo __('City') ?></label></td>
									<td colspan="2">
										<div id="div_sel_city"><?php include_partial('ajaxCity', array('geo_zone'=>$geo_zone, 'city'=>$city)); ?></div>
									</td>
								</tr>
								<tr>
									<td><label><?php echo __('Neighborhood') ?> *</label></td>
									<td colspan="2">
										<div id="div_sel_neighborhood">
											<?php include_partial('ajaxNeighborhood', array('city'=>$city, 'neighborhood'=>$neighborhood));?>
										</div>
									</td>
								</tr>
							</table>
						</td>
						<td valign="top">
							<table cellpadding="0" cellspacing="0">
								<tr><td><label><?php echo __('Google map') ?></label></td></tr>
								<tr><td><?php echo $form['google_map'] ?></td></tr>
							</table>
						</td>
					</tr>
				</table>
			</fieldset>
			<fieldset style="padding-top:3px;">
				<legend>&nbsp;<?php echo __('Features') ?>&nbsp;</legend>
				<table cellpadding="0" cellspacing="0">
					<tr><td height="5"></td></tr>
					<tr>
						<td colspan="10">
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td><label><?php echo __('Property type') ?> *&nbsp;</label></td>
									<td>
										<select name="property_type" class="form_input" style="width:315px;">
											<?php echo Common::fillSimpleSelect(PropertyTypeTable::getInstance()->getAllForSelect(true), $property_type) ?>
										</select>
									</td>
									<td class="lpadd_30 tright"><label>Garage</label></td>
									<td><?php echo $form['has_garage'] ?></td>
									<td class="lpadd_30 tright"><label>Pileta</label></td>
									<td><?php echo $form['has_swimming_pool'] ?></td>
									<td class="lpadd_30 tright"><label>Dep. servicio</label></td>
									<td><?php echo $form['has_dep_of_service'] ?></td>
									<td class="lpadd_30 tright"><label>Balcón</label></td>
									<td><?php echo $form['has_balcony'] ?></td>
									<td class="lpadd_30 tright"><label>Asador</label></td>
									<td><?php echo $form['has_bbq'] ?></td>			
								</tr>
							</table>
						</td>
					</tr>
					<tr><td height="15"></td></tr>
					<tr>
						<td><label>Terreno (m2)&nbsp;</label></td>
						<td><?php echo $form['square_meters'] ?></td>
						<td class="lpadd_30"><label>Mts. cubiertos (m2)&nbsp;</label></td>
						<td><?php echo $form['covered_area'] ?></td>
						<td class="lpadd_30"><label>Antigüedad (años)&nbsp;</label></td>
						<td><?php echo $form['years_antiquity'] ?></td>
						<td class="lpadd_30"><label>Baños&nbsp;</label></td>
						<td><?php echo $form['qty_bathrooms'] ?></td>
						<td class="lpadd_30"><label><?php echo __('Bedrooms') ?>&nbsp;</label></td>
						<td>
							<select name="bedroom" class="form_input">
								<?php echo Common::fillSimpleSelect(BedroomTable::getInstance()->getAllForSelect(), $bedroom) ?>
							</select>
						</td>
					</tr>
				</table>
			</fieldset>
			<fieldset style="padding-top:3px;">
				<legend>&nbsp;<?php echo __('Owner') ?>&nbsp;</legend>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td><label>Nombre&nbsp;</label></td>
						<td><?php echo $form['owner_name'] ?></td>
						<td class="lpadd_30"><label>Teléfono&nbsp;</label></td>
						<td><?php echo $form['owner_phone'] ?></td>
						<td class="lpadd_30"><label>Email&nbsp;</label></td>
						<td><?php echo $form['owner_email'] ?></td>
					</tr>
				</table>
			</fieldset>
      <div style="padding-top:10px;" class="botonera">
        <input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
        <input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action" />

        <input type="hidden" id="ajax_url_city" value="<?php echo url_for('property/ajaxCity') ?>"/>
        <input type="hidden" id="ajax_url_neighborhood" value="<?php echo url_for('property/ajaxNeighborhood') ?>"/>
        <?php echo $form->renderHiddenFields() ?>
     </div>
		</form>
	</div>
	<div class="clear"></div>
</div>