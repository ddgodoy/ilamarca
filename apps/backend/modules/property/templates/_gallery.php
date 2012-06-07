<?php if ($cant > 0): ?>
<div id="main_cont_gallery" style="width:100%;">
	<script type="text/javascript">
        $('document').ready(function(){

            $('.check-outstanding').click(function(){
              $(this).removeAttr('checked');
              var gallery = $(this).attr('id');
              var properti = $(this).attr('lang');
              var loader = document.getElementById('img_updating_gallery');

              jQuery.ajax({
						type: 'POST',
						url: $('#ajax_url_outstanding').val(),
						data: 'id_gallery='+gallery+'&id_property='+properti,
						success: function(data) {
							loader.style.visibility = 'hidden';

							$('#main_cont_gallery').html(data);
						}
	  			});
	    	 })
        });
		function confirmDelImage(image_id, property_id)
		{
			var loader = document.getElementById('img_updating_gallery');

			jConfirm('<?php echo __('confirm_delet_images') ?>', '<?php echo __('Check the information') ?>', function(r) {
	    	if (r) {
	    		loader.style.visibility = 'visible';

	      	jQuery.ajax({
						type: 'POST',
						url: $('#ajax_url_imagen').val(),
						data: 'id_gallery='+image_id+'&id_property='+property_id,
						success: function(data) {
							loader.style.visibility = 'hidden';

							$('#main_cont_gallery').html(data);
						}
	  			});
	    	}
	   	});
		}
	</script>
	<div style="height:10px;"></div>
  <?php foreach($gallery as $value): ?>
    <div class="div_cont_gal">
    	<a onclick="confirmDelImage(<?php echo $value->getId(); ?>, <?php echo $value->getRealPropertyId()?>);">
    		<img src="/admin/images/borrar_hover.png" class="img_gal_delete" title="<?php __('delete') ?>" />
    	</a>
      <img src="<?php echo $path.$value->getInternalName() ?>" alt="<?php echo $value->getFormerName()  ?>" border="0" />
      <input type="checkbox" id="<?php echo $value->getId(); ?>" title="Destacada" lang="<?php echo $value->getRealPropertyId()?>" class="check-outstanding" <?php if( $value->getOutstanding() == 1 ): ?> checked <?php endif; ?> style="margin-left: -2px" />
    </div>
  <?php endforeach; ?>

  <br clear="all"/>
  <input type="hidden" id="ajax_url_imagen" value="<?php echo url_for('property/ajaxImages') ?>"/>
  <input type="hidden" id="ajax_url_outstanding" value="<?php echo url_for('property/ajaxOutstanding') ?>"/>
</div>	
<?php endif; ?>