<?php
	$str_module = $sf_params->get('module');
	$str_action = $sf_params->get('action');
	$request_id = $id ?  "?id=$id" : '';
?>
<script type="text/javascript">
function updCityList(geo_zone_id)
{
	var l_img = document.getElementById('img_loading_cities');
	var s_url = document.getElementById('ajax_url_city').value;

	l_img.style.visibility = 'visible';

	jQuery.ajax({
		type: 'POST',
		url: s_url,
		data: 'geo_zone='+geo_zone_id,
		success: function(data) {
			l_img.style.visibility = 'hidden'; $('#div_sel_city').html(data);
		}
	});
	var sel_neighborhood = document.getElementById('neighborhood');

	sel_neighborhood.options.length = 0;
	sel_neighborhood[0] = new Option('<?php echo '-- '.__('Select').' --' ?>', '0');
	sel_neighborhood[0].selected = true;
}
//
function updNeighborhoodList(city_id)
{
	var l_img = document.getElementById('img_loading_neighborhoods');
	var s_url = document.getElementById('ajax_url_neighborhood').value;

	l_img.style.visibility = 'visible';

	jQuery.ajax({
		type: 'POST',
		url: s_url,
		data: 'city='+city_id,
		success: function(data) {
			l_img.style.visibility = 'hidden'; $('#div_sel_neighborhood').html(data);
		}
	});
}
</script>
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
							<td style="padding-left:30px;">
								<label><?php echo __('City') ?></label>
								<img src="/admin/images/loader.gif" id="img_loading_neighborhoods" border="0" style="visibility:hidden;"/>
							</td>
							<td style="padding-left:30px;">
								<label><?php echo __('Neighborhood') ?></label>
							</td>
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
									<?php include_partial('ajaxNeighborhood', array('city'=>$city, 'neighborhood'=>$neighborhood)); ?>
								</div>
							</td>
						</tr>
					</table>
				</fieldset>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
					<tr>
						<td width="10%"><label><?php echo __('Property type') ?> *</label></td>
						<td>
							<select name="property_type" class="form_input" style="width:300px;">
								<?php echo Common::fillSimpleSelect(PropertyTypeTable::getInstance()->getAllForSelect(true), $property_type) ?>
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