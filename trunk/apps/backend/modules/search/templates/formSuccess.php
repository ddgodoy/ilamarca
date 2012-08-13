<?php
	$str_module = $sf_params->get('module');
	$str_action = $sf_params->get('action');
	$request_id = $id ?  "?id=$id" : '';
?>
<script type="text/javascript" src="/js/search.js"></script>
<div class="content">
	<div class="leftside" style="margin-left:250px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('search/index') ?>"><strong>Perfiles de búsqueda</strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __(ucfirst($str_action)) ?>
		</div>
		<?php if ($error): ?>
			<div class="mensajeSistema error"><ul><li><?php echo $error ?></li></ul></div>
		<?php endif; ?>
		<h1 class="titulos">Nuevo perfil de búsqueda</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo url_for($str_module.'/'.$str_action).$request_id ?>">
			<label class="lineaListados"><?php echo __('Mandatory fields') ?>&nbsp;(*)</label>
			<img src="/admin/images/loader.gif" id="img_loading" border="0" class="ajax_img" style="vertical-align:middle;padding-left:20px;"/>
			<br />
			<fieldset>
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td valign="top" width="33%">
							<table width="100%" cellspacing="4" cellpadding="3" border="0">
								<tr>
									<td>
										<select name="property_type" class="et_input" style="width:300px;">
											<?php echo Common::fillSimpleSelect($db_properties, $sel_tipo) ?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<select name="operation" class="et_input" style="width:300px;">
											<?php echo Common::fillSimpleSelect($db_operations, $sel_operacion) ?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<select name="geo_zone" id="geo_zone" onchange="updCityList(this.value);" class="et_input" style="width:300px;">
											<?php echo Common::fillSimpleSelect($db_geo_zones, $sel_geo_zone) ?>
										</select>
									</td>
								</tr>
								<tr><td><div id="div_sel_city"><?php include_partial('search/ajaxCity'); ?></div></td></tr>
								<tr><td><div id="div_sel_neighborhood"><?php include_partial('search/ajaxNeighborhood'); ?></div></td>
								</tr>
								<tr>
									<td>
										<select name="bedroom" class="et_input" style="width:300px;">
											<?php echo Common::fillSimpleSelect($db_bedrooms) ?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<table cellpadding="0" cellspacing="0">
											<tr>
												<td style="text-align:center;"><label>Precio desde</label></td><td width="5"></td>
												<td style="text-align:center;"><label>Precio hasta</label></td><td width="5"></td>
												<td style="text-align:center;"><label>Moneda</label></td>
											</tr>
											<tr>
												<td><input type="text" name="p_from" value="<?php echo $p_from ?>" class="form_input" style="width:92px;text-align:right;" onkeypress="return onlyDecimal(this, event);"/></td>
												<td width="5"></td>
												<td><input ype="text" name="p_to" value="<?php echo $p_to ?>" class="form_input" style="width:92px;text-align:right;" onkeypress="return onlyDecimal(this, event);"/></td>
												<td width="5"></td>
												<td>
													<select name="currency" class="et_input" style="width:90px;text-align:center;font-size:12px;">
														<option value="0" selected>---</option>
														<?php echo Common::fillSimpleSelect($db_currencies, $sel_currency) ?>
													</select>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
						<td valign="top" width="67%">
							<table cellspacing="4" cellpadding="3" border="0">
								<tr>
									<td style="text-align:right;"><label>* Nombre:</label></td>
									<td>
										<input type="text" name="p_nombre" value="<?php echo $p_nombre ?>" class="form_input" style="width:400px;"/>
									</td>
								</tr>
								<tr>
									<td></td>
									<td><em style="font-size:12px;">(denominación para la búsqueda)</em></td>
								</tr>
								<tr><td height="40"></td></tr>
								<tr>
									<td style="text-align:right;"><label>* Referencia:</label></td>
									<td>
										<input type="text" name="p_referencia" value="<?php echo $p_referencia ?>" class="form_input" style="width:400px;"/>
									</td>
								</tr>
								<tr>
									<td></td>
									<td><em style="font-size:12px;">(a nombre de quién se está realizando esta búsqueda)</em></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</fieldset>
			<div style="padding-top:10px;" class="botonera">
				<input type="button" onclick="document.location='<?php echo url_for($str_module.'/index') ?>';" value="<?php echo __('Cancel') ?>" class="boton" />
				<input type="submit" name="btn_action" value="<?php echo __('Register') ?>" class="boton" id="btn_action" />

				<input type="hidden" id="ajax_url_city" value="<?php echo url_for('search/ajaxCity') ?>"/>
				<input type="hidden" id="ajax_url_neighborhood" value="<?php echo url_for('search/ajaxNeighborhood') ?>"/>
				<input type="hidden" id="lbl_neighborhood" value="<?php echo '-- '.__('Neighborhood').' --' ?>"/>
			</div>
		</form>
	</div>
	<div class="clear"></div>
</div>