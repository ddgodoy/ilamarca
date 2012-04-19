<?php
	$city = !empty($city) ? $city : 0;
	$vals = NeighborhoodTable::getInstance()->getByCityId($city, 'Neighborhood');
?>
<select name="neighborhood" id="neighborhood" class="et_input">
	<?php echo Common::fillSimpleSelect($vals) ?>
</select>