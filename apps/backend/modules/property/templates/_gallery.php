<?php if ($cant > 0): ?>
<div id="main_cont_gallery" style="width:100%;">
	<script type="text/javascript">
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
    </div>
  <?php endforeach; ?>

  <br clear="all"/>
	<input type="hidden" id="ajax_url_imagen" value="<?php echo url_for('property/ajaxImages') ?>"/>
</div>	
<?php endif; ?>