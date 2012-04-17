<?php
	$city = !empty($city) ? $city : 0;
	$neighborhood = !empty($neighborhood) ? $neighborhood : 0;

        $aValues = array('0'=>'-- '.__('Select').' --');
	$aValues = $aValues + NeighborhoodTable::getInstance()->getByCityId($city);
?>
<select name="neighborhood" id="neighborhood" class="form_input" style="width:300px;">
	<?php echo Common::fillSimpleSelect($aValues, $neighborhood) ?>
</select>