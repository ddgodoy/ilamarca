<?php
	$geo_zone = !empty($geo_zone) ? $geo_zone : 0;
	$city = !empty($city) ? $city : 0;

	$aValues = CityTable::getInstance()->getByGeoZoneId($geo_zone);
?>
<select name="city" class="form_input" style="width:408px;">
	<?php echo Common::fillSimpleSelect($aValues, $city) ?>
</select>