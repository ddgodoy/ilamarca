$(document).ready(function() {
  $('#country').change(function(){
    var country = $(this).val();
    $('#img_updating_gallery').show();
    jQuery.ajax({
            type: 'POST',
            url: $('#geo_zone_url').val(),
            data: 'country='+country,
            success: function(data) {
                $('#img_updating_gallery').hide();
                $('#geo_zone_td').html(data);
                if($('#city-id'))
                {
                  $('#city-id').html('<option selected="" value="0">-- '+$('#value-select').val()+' --</option>');
                }
                if($('#neighborhood-id'))
                {
                  $('#neighborhood-id').html('<option selected="" value="0">-- '+$('#value-select').val()+' --</option>');
                }
            }
    });
  })
});
