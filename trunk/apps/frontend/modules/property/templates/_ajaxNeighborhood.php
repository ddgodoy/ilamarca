<?php
	$city = !empty($city) ? $city : 0;
	$vals = NeighborhoodTable::getInstance()->getByCityId($city, 'Neighborhood');

	$et_filter = !empty($et_filter) ? $et_filter : '';
	$neighborhood = !empty($neighborhood) ? $neighborhood : 0;
?>
<select name="neighborhood" id="neighborhood" class="et_input <?php echo $et_filter ?>">
	<?php echo Common::fillSimpleSelect($vals, $neighborhood) ?>
</select>