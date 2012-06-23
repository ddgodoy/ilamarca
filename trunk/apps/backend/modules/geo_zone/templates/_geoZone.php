<select name="geo_zone" class="form_input" style="width:<?php if(!empty($w)): ?><?php echo $w.'px;'; ?><?php else: ?> 408px; <?php endif; ?>" <?php if($is_neighborhood): ?> onchange="updCityList(this.value);" <?php endif; ?>>
    <?php echo Common::fillSimpleSelect($geo_zone_select, $geo_zone) ?>
</select>
