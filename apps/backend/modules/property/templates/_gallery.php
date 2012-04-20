<script type="text/javascript">
$(document).ready(function()
{
    $('.img_delete').click(function(){
        var id = $(this).attr('id');
        var id_property = $(this).attr('lang');
        var s_url = $('#ajax_url_imagen').val();
        jConfirm('<?php echo __('confirm_delet_images') ?>', '<?php echo __('Check the information') ?>', function(r) {
        if(r)
        {
           jQuery.ajax({
		type: 'POST',
		url: s_url,
		data: 'id_gallery='+id+'&id_property='+id_property,
		success: function(data) {
                    $('.div_images').html(data);
		}
	    });
        }
       });
     });
})
</script>
<?php if($cant > 0): ?>
    <ul>
        <?php foreach($gallery AS $value): ?>
            <li class="li_images">
                <img src="<?php echo $path.$value->getInternalName() ?>" alt="<?php echo $value->getFormerName()  ?>" />
                <img src="/admin/images/borrar_hover.png" id="<?php echo $value->getId(); ?>" lang="<?php echo $value->getRealPropertyId()?>" class="img_delete" alt="<?php __('delete') ?>" title="<?php __('delete') ?>">
            </li>
        <?php endforeach; ?>
    </ul>
    <br clear="all"/>
<?php endif; ?>
<input type="hidden" id="ajax_url_imagen" value="<?php echo url_for('property/ajaxImages') ?>"/>