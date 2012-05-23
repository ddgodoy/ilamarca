<?php
	$city = !empty($city) ? $city : 0;
	$neighborhood = !empty($neighborhood) ? $neighborhood : 0;

	$aValues = NeighborhoodTable::getInstance()->getByCityId($city, '', false);
?>
<select id="neighborhood" multiple size="8" class="form_input" style="width:310px;">
	<?php echo Common::fillSimpleSelect($aValues, $neighborhood) ?>
</select>