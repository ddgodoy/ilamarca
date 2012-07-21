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
			<a href="<?php echo url_for('city/index') ?>"><strong><?php echo __('Cities') ?></strong></a>
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
			<?php echo __(ucfirst($str_action)).' '.__('City') ?>
		</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for($str_module.'/'.$str_action).$request_id ?>">
			<label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label><br />
			<fieldset>
				<table width="100%" cellspacing="4" cellpadding="0" border="0">
          <tr>
						<td width="6%"><label><?php echo __('Country') ?> *</label></td>
						<td><?php echo $form['country_id'] ?></td>
					</tr>
					<tr>
						<td width="10%"><label><?php echo __('Geo zone') ?> *</label></td>
						<td id="geo_zone_td">
              <div  style="display:none;position:absolute;margin-bottom:20px;margin-left:415px;" id="img_updating_gallery"  >
              	<img border="0" src="/admin/images/loader.gif">
              </div>
              <?php include_component('geo_zone', 'geoZone', array('geo_zone'=>$geo_zone!=''?$geo_zone:$form['geo_zone_id']->getValue(), 'country_id'=>$form['country_id']->getValue(), ''=>'')); ?>
						</td>
					</tr>
					<tr>
						<td><label><?php echo __('Name') ?> *</label></td>
						<td><?php echo $form['name'] ?></td>
					</tr>
				</table>
			</fieldset>
			<div style="padding-top:10px;" class="botonera">
				<input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
				<input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action" />
				<input type="hidden" value="<?php echo url_for('geo_zone/getGeoZone') ?>" id="geo_zone_url" />

				<?php echo $form->renderHiddenFields() ?>
			</div>
		</form>
	</div>
	<div class="clear"></div>
</div>