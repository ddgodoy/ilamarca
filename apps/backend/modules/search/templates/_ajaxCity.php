<?php
	$geo_zone = !empty($geo_zone) ? $geo_zone : 0;
	$a_values = CityTable::getInstance()->getByGeoZoneId($geo_zone, 'Town');

  $et_filter = !empty($et_filter) ? $et_filter : '';
  $city = !empty ($city) ? $city : 0;
?>
<select name="city" id="city" class="et_input <?php echo $et_filter ?>" onchange="updNeighborhoodList(this.value);" style="width:300px;">
	<?php echo Common::fillSimpleSelect($a_values, $city) ?>
</select>