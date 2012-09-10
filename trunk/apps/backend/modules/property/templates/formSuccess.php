<?php
	$str_module = $sf_params->get('module');
	$str_action = $sf_params->get('action');
	$request_id = $id ?  "?id=$id" : '';
	
	if (count($videos) == 0) { $videos = array(''); }
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

    <?php if ($sf_user->getFlash('notice')): ?>
    <div class="mensajeSistema ok">
      <ul><li><?php echo __('La propiedad se ha actualizado correctamente') ?></li></ul>
    </div>
    <?php endif; ?>

		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Property') ?>
		</h1>
		<?php if (!empty($qrcode_img)): ?>
    <div style="border:1px solid #CCCCCC;width:200px;height:200px;position:absolute;margin-left:1015px;margin-top:77px;">
        <img src="/uploads/qr_codes/<?php echo $qrcode_img ?>" alt="qr" title="qr" />
    </div>
    <?php endif; ?>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for($str_module.'/'.$str_action).$request_id ?>">
			<label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label>
			<br />
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="10%" id="td_idioma_es" class="tab_idiomas_on" onclick="changeTabsOnclick('es');">Info en Español</td>
					<td width="10%" id="td_idioma_en" class="tab_idiomas_off" onclick="changeTabsOnclick('en');">Info en Inglés</td>
					<td width="80%">
						<div style="width:100%;">
							<span style="padding-left:223px;font-size:13px;color:#333333;"><strong>Habilitada</strong></span>
							<?php echo $form['enabled'] ?>
						</div>
					</td>
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
									<td valign="top"><label>Name</label></td><td width="22"></td>
									<td valign="top"><label>Description</label></td>
								</tr>
								<tr>
									<td valign="top">
										<table cellpadding="0" cellspacing="0">
											<tr><td><?php echo $form['en']['name'] ?></td></tr>
											<tr><td height="10"></td></tr>
											<tr><td><label>Address</label></td></tr>
											<tr><td><?php echo $form['en']['address'] ?></td></tr>
											<tr><td height="8"></td></tr>
											<tr><td><label>Transports</label></td></tr>
											<tr><td><?php echo $form['en']['transports'] ?></td></tr>
										</table>
									</td><td width="22"></td>
									<td valign="top">
										<table cellpadding="0" cellspacing="0">
											<tr><td><?php echo $form['en']['detail'] ?></td></tr>
											<tr><td height="10"></td></tr>
											<tr><td><label>Points of reference</label></td></tr>
											<tr><td><?php echo $form['en']['points_of_ref'] ?></td></tr>
										</table>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
			<fieldset>
				<legend>&nbsp;<?php echo __('Operation') ?>&nbsp;</legend>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<?php foreach ($db_operations as $id_ope => $db_ope): ?>
							<td style="padding-right:74px;">
								<table cellpadding="0" cellspacing="0">
									<tr>
										<td>
			                <?php $operations = is_array($sf_data->getRaw('sl_operations')) ? $sf_data->getRaw('sl_operations') : array(); ?>
			                <input type="checkbox" name="operations[]" value="<?php echo $id_ope ?>" <?php if (in_array($id_ope, $operations)) { echo 'checked'; } ?>  style="vertical-align:middle;" />
											<label><?php echo $db_ope ?>&nbsp;&nbsp;</label>
										</td>
										<td>
			                <?php
			                	$aCurrency = $sf_data->getRaw('sl_currencies');
			                	$selected = !empty($aCurrency[$id_ope]['id']) ? $aCurrency[$id_ope]['id'] : '';
			                ?>
											<select class="form_input" name="currencies[<?php echo $id_ope ?>][id]">
			                  <?php echo Common::fillSimpleSelect(CurrencyTable::getInstance()->getAllForSelect(), $selected) ?>
											</select>
										</td>
										<td>
			                <?php
			                	$array_prices =  $sf_data->getRaw('sl_prices');
			                	$value = !empty($array_prices[$id_ope]['number']) ? $array_prices[$id_ope]['number'] : '0.00';
			                ?>
			                <input type="text" class="form_input" name="prices[<?php echo $id_ope ?>][number]" style="width:100px;text-align:right;" value="<?php echo $value ?>" onkeypress="return onlyDecimal(this, event);"/>
			              </td>
									</tr>
								</table>
							</td>
						<?php endforeach; ?>
					</tr>
				</table>
			</fieldset>
			<fieldset style="margin-top:10px;padding-top:3px;">
				<legend>&nbsp;<?php echo __('Location') ?>&nbsp;</legend>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top">
							<table cellpadding="3" cellspacing="0">
                <tr>
                  <td width="6%"><label><?php echo __('Country') ?></label></td>
                  <td><?php echo $form['country_id'] ?></td>
                </tr>
								<tr>
									<td><label><?php echo __('Geo zone') ?></label></td>
									<td id="geo_zone_td">
                    <div  style="display: none; position: absolute; margin-bottom: 20px; margin-left: 315px" id="img_updating_gallery"  >
                      <img border="0" src="/admin/images/loader.gif">
                    </div>
                    <?php include_component('geo_zone', 'geoZone', array('geo_zone'=>$geo_zone, 'country_id'=>$form['country_id']->getValue(), ''=>'', 'is_neighborhood'=>true, 'w'=>'300')); ?>
                  </td>
                  <td>
                    <img src="/admin/images/loader.gif" id="img_loading_cities" border="0" style="visibility:hidden;"/>
                  </td>
								</tr>
								<tr>
									<td><label><?php echo __('City') ?></label></td>
									<td colspan="2">
										<div  style="display: none; position: absolute; margin-bottom: 20px; margin-left: 415px" id="img_ajax_loading"  >
                      <img border="0" src="/admin/images/loader.gif">
                    </div>
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
			<div class="div_cont_ytvideos">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td><label style="color:#333333;"><strong>Archivo PDF</strong></label></td>
						<td style="padding-left:5px;"><input type="file" name="pdf_file" class="form_input"/></td>
						<td style="padding-left:5px;">
							<?php if ($pdf_file): ?>
								<input type="checkbox" name="reset_pdf_file" />&nbsp;<label><?php echo __('Check to delete') ?></label>
							<?php endif; ?>
						</td>
					</tr>
				</table>
			</div>
			<div class="div_cont_ytvideos">
				<label style="color:#333333;"><strong><?php echo __('Video') ?> Youtube</strong></label>
				<table cellpadding="0" cellspacing="0" id="tb_videos_youtube">
				<?php foreach ($videos as $v_video): ?>
					<tr><td><textarea name="videos[]" class="form_input area_yt"><?php echo $v_video ?></textarea></td></tr>
				<?php endforeach; ?>
				</table>
			</div>
			<div class="div_cont_ytvideos">
				<div class="div_cont_add_ytvideos">
					<a class="linkPinika" id="plupload_pick_file">+ Seleccionar</a>
				</div>
				<div class="div_cont_add_ytvideos" style="margin-top:20px;">
					<img src="/admin/images/loader.gif" id="img_updating_gallery" border="0" style="visibility:hidden;"/>
				</div>
				<label style="color:#333333;"><strong>Galería de imágenes</strong></label>
				<div style="float:right;">
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td style="padding-right:6px;"><input type="checkbox" name="watermark" <?php if ($watermark): ?>checked<?php endif; ?>/></td>
							<td><label style="color:#333333;"><strong>Marca de agua activada</strong></label></td>
						</tr>
					</table>
				</div>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top">
							<table cellpadding="0" cellspacing="0" class="plupload_list" id="plupload_tb_list">
								<tr>
									<th width="325">Archivo</th>
									<th width="100">Tamaño</th>
									<th width="200" colspan="3" class="plupload_center">Subido</th>
								</tr>
								<tr id="plupload_temp_row"><td colspan="5">&nbsp;</td></tr>
							</table>
						</td>
					</tr>
				</table>
				<?php
      		include_component('property', 'gallery' , array('id'=>$id));
      	?>
				<input type="hidden" name="plupload_files" id="plupload_hidden_files" class="plupload_none" />
				<input type="hidden" id="plupload_filters" value="jpg,gif,png,JPG,GIF,PNG" />
				<input type="hidden" id="plupload_get_folder" value="/admin/plupload/" />
				<input type="hidden" id="plupload_max_size" value="10" />
			</div>
      <div style="padding-top:10px;" class="botonera">
        <input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
        <input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action" />

        <input type="hidden" id="ajax_url_city" value="<?php echo url_for('property/ajaxCity') ?>"/>
        <input type="hidden" id="ajax_url_neighborhood" value="<?php echo url_for('property/ajaxNeighborhood') ?>"/>
        <?php echo $form->renderHiddenFields() ?>
        <input type="hidden" value="<?php echo url_for('geo_zone/getGeoZone?is_neighborhood=1&is_property=300') ?>" id="geo_zone_url" />
        <input type="hidden" value="<?php echo __('Select') ?>" id="value-select" />
     </div>
		</form>
	</div>
	<div class="clear"></div>
</div>