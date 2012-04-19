<?php
	$geo_zone = !empty($geo_zone) ? $geo_zone : 0;
	$a_values = CityTable::getInstance()->getByGeoZoneId($geo_zone, 'Town');
?>
<select name="city" class="et_input" onchange="updNeighborhoodList(this.value);">
	<?php echo Common::fillSimpleSelect($a_values) ?>
</select>