$(document).ready(function(){
    $('#add').css('cursor','pointer');
    $('#add').click(function(){
        $('#img_loading_video').show();
        var id = Math.floor(Math.random()*101);
        var mod_tr = $('<tr>').attr('id',id);
        $('#table_content').append(mod_tr);
        var html_text = '<td><textarea rows="4" cols="30" class="form_input" style="width: 600px; height: 100px;" name="video[]" id="real_property_es_detail"></textarea></td><td  class="close"><img onclick="close_tr('+id+')" src="/admin/images/borrar_hover.png"></td>'
        $('#'+id).html(html_text);
        $('#img_loading_video').hide();
    });
});

function close_tr(id)
{
    $('#'+id).remove();
}

function updCityList(geo_zone_id)
{
	var l_img = document.getElementById('img_loading_cities');
	var s_url = document.getElementById('ajax_url_city').value;

	l_img.style.visibility = 'visible';

	jQuery.ajax({
		type: 'POST',
		url: s_url,
		data: 'geo_zone='+geo_zone_id,
		success: function(data) {
			l_img.style.visibility = 'hidden';
                        $('#div_sel_city').html(data);
                        updNeighborhoodList(0)
		}
	});
}
//
function updNeighborhoodList(city_id)
{
	var l_img = document.getElementById('img_loading_neighborhoods');
	var s_url = document.getElementById('ajax_url_neighborhood').value;

	l_img.style.visibility = 'visible';

	jQuery.ajax({
		type: 'POST',
		url: s_url,
		data: 'city='+city_id,
		success: function(data) {
			l_img.style.visibility = 'hidden';
                        $('#div_sel_neighborhood').html(data);
		}
	});
}