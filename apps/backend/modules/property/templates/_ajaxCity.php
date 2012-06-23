<?php
	$geo_zone = !empty($geo_zone) ? $geo_zone : 0;
	$city = !empty($city) ? $city : 0;

	$aValues = CityTable::getInstance()->getByGeoZoneId($geo_zone);
?>
<select name="city" id="city-id" class="form_input" style="width:300px;" onchange="updNeighborhoodList(this.value);">
	<?php echo Common::fillSimpleSelect($aValues, $city) ?>
</select>