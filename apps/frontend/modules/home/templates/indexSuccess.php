<?php if ($sf_user->getFlash('activate')): ?>
	<br /><div class="mensajeSistema ok">Tu cuenta fue activada exitosamente!</div>
<?php endif; ?>
<div class="left">
	<div class="buscador">
		<div class="titulo"></div>
		<form action="<?php echo url_for('search/index') ?>" method="POST" enctype="multipart/form-data">
			<div class="search_box clearfix">
				<img src="/admin/images/loader.gif" id="img_loading" border="0" class="ajax_img"/>
				<div class="space_bottom">
					<select name="property_type" class="et_input">
						<?php echo Common::fillSimpleSelect($db_properties) ?>
					</select>
				</div>
				<div class="space_bottom">
					<select name="operation" class="et_input">
						<?php echo Common::fillSimpleSelect($db_operations) ?>
					</select>
				</div>
				<div class="space_bottom">
					<select name="geo_zone" id="geo_zone" onchange="updCityList(this.value);" class="et_input">
						<?php echo Common::fillSimpleSelect($db_geo_zones) ?>
					</select>
				</div>
				<div class="space_bottom">
					<div id="div_sel_city"><?php include_partial('property/ajaxCity'); ?></div>
				</div>
				<div class="space_bottom">
					<div id="div_sel_neighborhood"><?php include_partial('property/ajaxNeighborhood'); ?></div>
				</div>
				<div class="space_bottom">
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td class="et_label" style="text-align:center;">Desde</td><td width="5"></td>
							<td class="et_label" style="text-align:center;">Hasta</td><td width="5"></td>
							<td class="et_label" style="text-align:center;">Moneda</td>
						</tr>
						<tr>
							<td><input type="text" name="p_from" class="et_input" style="width:100px;text-align:right;" onkeypress="return onlyDecimal(this, event);"/></td>
							<td width="5"></td>
							<td><input ype="text" name="p_to" class="et_input" style="width:100px;text-align:right;" onkeypress="return onlyDecimal(this, event);"/></td>
							<td width="5"></td>
							<td>
								<select name="currency" class="et_input" style="width:90px;text-align:center;font-size:12px;">
									<option value="0" selected>---</option>
									<?php echo Common::fillSimpleSelect($db_currencies) ?>
								</select>
							</td>
						</tr>
					</table>
				</div>	
				<div>
					<select name="bedroom" class="et_input">
						<?php echo Common::fillSimpleSelect($db_bedrooms) ?>
					</select>
				</div>
			</div>
			<div class="boton"><input type="submit" value="" class="et_btn_buscar"/></div>
		</form>
	</div>
</div>
<?php include_partial('home/right_static') ?>

<input type="hidden" id="ajax_url_city" value="<?php echo url_for('property/ajaxCity') ?>"/>
<input type="hidden" id="ajax_url_neighborhood" value="<?php echo url_for('property/ajaxNeighborhood') ?>"/>
<input type="hidden" id="lbl_neighborhood" value="<?php echo '-- '.__('Neighborhood').' --' ?>"/>