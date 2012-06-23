<?php
	$city = !empty($city) ? $city : 0;
	$neighborhood = !empty($neighborhood) ? $neighborhood : 0;

	$aValues = NeighborhoodTable::getInstance()->getByCityId($city);
?>
<select name="neighborhood" id="neighborhood-id" id="neighborhood" class="form_input" style="width:300px;">
	<?php echo Common::fillSimpleSelect($aValues, $neighborhood) ?>
</select>