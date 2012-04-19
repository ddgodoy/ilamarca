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
		<?php if ($form->hasErrors() || count($error) > 0): ?>
			<div class="mensajeSistema error">
				<ul>
					<?php foreach ($error as $e): ?><li><?php echo __($e, NULL, 'errors') ?></li><?php endforeach; ?>
					<?php foreach($form->getFormFieldSchema() as $name=>$formField) { if ($formField->getError()) { echo '<li>'.$formField->getError().'</li>'; } } ?>
				</ul>
			</div>
		<?php endif; ?>
		<h1 class="titulos">
			<?php echo __(ucfirst($str_action)).' '.__('Property') ?>
		</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for($str_module.'/'.$str_action).$request_id ?>">
			<label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
				<fieldset style="padding-top:3px;">
					<legend>&nbsp;<?php echo __('Location') ?>&nbsp;</legend>
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td>
								<label><?php echo __('Geo zone') ?></label>
								<img src="/admin/images/loader.gif" id="img_loading_cities" border="0" style="visibility:hidden;"/>
							</td>
							<td style="padding-left:30px;"><label><?php echo __('City') ?></label></td>
							<td style="padding-left:30px;"><label><?php echo __('Neighborhood') ?> *</label></td>
						</tr>
						<tr>
							<td>
								<select name="geo_zone" class="form_input" style="width:300px;" onchange="updCityList(this.value);">
									<?php echo Common::fillSimpleSelect(GeoZoneTable::getInstance()->getAllForSelect(true), $geo_zone) ?>
								</select>
							</td>
							<td style="padding-left:30px;">
								<div id="div_sel_city">
									<?php include_partial('ajaxCity', array('geo_zone'=>$geo_zone, 'city'=>$city)); ?>
								</div>
							</td>
							<td style="padding-left:30px;">
								<div id="div_sel_neighborhood">
									<?php include_partial('ajaxNeighborhood', array('city'=>$city, 'neighborhood'=>$neighborhood));?>
								</div>
							</td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend>&nbsp;<?php echo __('Operation') ?>&nbsp;</legend>
					<table cellpadding="0" cellspacing="0">
						<tr>
							<?php foreach ($db_operations as $id_ope => $db_ope): ?>
								<td style="padding-right:85px;">
									<table cellpadding="0" cellspacing="0">
										<tr>
											<td>
				                <?php $operations = is_array($sf_data->getRaw('sl_operations')) ? $sf_data->getRaw('sl_operations') : array(); ?>
				                <input type="checkbox" name="operations[]" value="<?php echo $id_ope ?>" <?php if (in_array($id_ope, $operations)) { echo 'checked'; } ?>  style="vertical-align:middle;" />
												<label><?php echo $db_ope ?>&nbsp;&nbsp;</label>
											</td>
											<td>
				                <?php $array_currencie =  $sf_data->getRaw('sl_currencies'); ?>
				                <?php $selected = !empty($array_currencie[$id_ope]['id']) ? $array_currencie[$id_ope]['id'] : ''; ?>
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
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="10%"><label><?php echo __('Property type') ?> *</label></td>
						<td>
							<select name="property_type" class="form_input" style="width:314px;">
								<?php echo Common::fillSimpleSelect(PropertyTypeTable::getInstance()->getAllForSelect(true), $property_type) ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label><?php echo __('Bedrooms') ?> *</label></td>
						<td>
							<select name="bedroom" class="form_input" style="width:314px;">
								<?php echo Common::fillSimpleSelect(BedroomTable::getInstance()->getAllForSelect(), $bedroom) ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label><?php echo __('Name') ?> *</label></td>
						<td><?php echo $form['name'] ?></td>
					</tr>
					<tr>
						<td><label><?php echo __('Detail') ?></label></td>
						<td>
							<table cellpadding="0" cellspacing="0">
								<tr><td><?php echo $form['es']['detail'] ?></td><td>&nbsp;<label>[ES]</label></td></tr>
								<tr><td><?php echo $form['en']['detail'] ?></td><td>&nbsp;<label>[EN]</label></td></tr>
							</table>
						</td>
					</tr>
				</table>
				<fieldset>
					<legend>&nbsp;<label><?php echo __('Videos') ?> Youtube</label>&nbsp;</legend>
					<div style="width:730px;">
						<div style="float:right;"><label id="add" style="cursor:pointer;">+&nbsp;<?php echo __('Add') ?></label></div>
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<table cellpadding="0" cellspacing="0" id="table_content">
										<?php foreach ($videos as $i_video => $v_video): ?>
			              	<tr id="<?php echo $i_video ?>">
				              	<td><textarea class="form_input area_yt" name="videos[]"><?php echo $v_video ?></textarea></td>
				              	<td class="close"><img onclick="close_tr(<?php echo $i_video ?>)" src="/admin/images/borrar_hover.png"></td>
				              </tr>
			              <?php endforeach; ?>
			            </table>
								</td>
							</tr>
						</table>
					</div>
				</fieldset>
			</fieldset>
			<div style="padding-top:10px;" class="botonera">
				<input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
				<input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action" />

				<input type="hidden" id="ajax_url_city" value="<?php echo url_for('property/ajaxCity') ?>"/>
				<input type="hidden" id="ajax_url_neighborhood" value="<?php echo url_for('property/ajaxNeighborhood') ?>"/>
        <input type="hidden" id="ajax_url_videos" value="<?php echo url_for('property/ajaxVideos') ?>"/>

				<?php echo $form->renderHiddenFields() ?>
			</div>
		</form>
	</div>
	<div class="clear"></div>
</div>