<div class="box clearfix filtros filtrar">
	<div class="inner clearfix">
		<div class="titulo">
			<img src="images/tit_filtrosaplicados.png" alt="Filtros Aplicados" />
		</div>
		<form action="<?php echo url_for('search/index') ?>" method="POST" enctype="multipart/form-data" class="clearfix">
			<div align="center">
				<img src="/admin/images/loader.gif" id="img_loading" border="0" class="ajax_img" style="margin-left:9px;float:left;"/>
				<div class="rowElem padding-bottom5">
					<select name="property_type" class="et_input et_filter">
						<?php echo Common::fillSimpleSelect($db_properties, $property_type) ?>
					</select>
				</div>
				<div class="rowElem padding-bottom5">
					<select name="operation" class="et_input et_filter">
						<?php echo Common::fillSimpleSelect($db_operations, $operation) ?>
					</select>
				</div>
				<div class="rowElem padding-bottom5">
					<select name="geo_zone" id="geo_zone" onchange="updCityList(this.value);" class="et_input et_filter">
						<?php echo Common::fillSimpleSelect($db_geo_zones, $geo_zone) ?>
					</select>
				</div>
				<div class="rowElem padding-bottom5">
					<div id="div_sel_city">
						<?php include_partial('property/ajaxCity',array('et_filter'=>'et_filter', 'geo_zone'=>$geo_zone, 'city'=>$city)); ?>
					</div>
				</div>
				<div class="rowElem padding-bottom5">
					<div id="div_sel_neighborhood">
						<?php include_partial('property/ajaxNeighborhood',array('et_filter'=>'et_filter', 'city'=>$city, 'neighborhood'=>$neighborhood)); ?>
					</div>
				</div>
				<div class="rowElem padding-bottom5">
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td class="et_label" style="text-align:center;font-size:12px;">Desde</td>
							<td class="et_label" style="text-align:center;font-size:12px;padding-left:5px;">Hasta</td>
							<td class="et_label" style="text-align:center;font-size:12px;padding-left:5px;">Moneda</td>
						</tr>
						<tr>
							<td><input type="text" name="p_from" class="et_input" value="<?php echo $p_desde?>" style="width:65px;text-align:right;" onkeypress="return onlyDecimal(this, event);"/></td>
							<td style="padding-left:5px;"><input type="text" name="p_to" class="et_input" value="<?php echo $p_hasta ?>" style="width:65px;text-align:right;" onkeypress="return onlyDecimal(this, event);"/></td>
							<td style="padding-left:5px;">
								<select name="currency" class="et_input" style="width:90px;font-size:12px;">
									<option value="0">---</option>
									<?php echo Common::fillSimpleSelect($db_currencies, $currency) ?>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div class="rowElem padding-bottom5">
					<select name="bedroom" class="et_input et_filter"><?php echo Common::fillSimpleSelect($db_bedrooms, $bedrooms) ?></select>
				</div>
				<div class="boton" style="padding: 15px;"><input type="submit" value="" class="et_btn_buscar"/></div>
			</div>
		</form>
	</div>
</div>
<div class="sombra"></div>

<input type="hidden" id="ajax_url_city" value="<?php echo url_for('property/ajaxCity') ?>"/>
<input type="hidden" id="ajax_url_neighborhood" value="<?php echo url_for('property/ajaxNeighborhood') ?>"/>
<input type="hidden" id="lbl_neighborhood" value="<?php echo __('Neighborhood') ?>"/>