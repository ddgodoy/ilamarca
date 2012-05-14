$(document).ready(function()
{
	$('#add').click(function()
	{
		var id = Math.floor(Math.random()*101);
		var mod_tr = $('<tr>').attr('id',id);

		$('#table_content').append(mod_tr);

		var html_text = '<td><textarea class="form_input area_yt" name="videos[]"></textarea></td>'+
									  '<td class="close"><img onclick="close_tr('+ id +')" src="/admin/images/borrar_hover.png"></td>'

		$('#'+id).html(html_text);
	});
});
//
function close_tr(id)
{
  $('#'+id).remove();
}
//
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
      $('#div_sel_city').html(data);updNeighborhoodList(0)
		}
	});
}
//
function updNeighborhoodList(city_id)
{
	var l_img = document.getElementById('img_loading_cities');
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
//
function changeTabsOnclick(lang)
{
	var div_es = document.getElementById('div_content_info_es');
	var div_en = document.getElementById('div_content_info_en');
	var tab_es = document.getElementById('td_idioma_es');
	var tab_en = document.getElementById('td_idioma_en');
	
	div_es.style.display = 'none';
	div_en.style.display = 'none';
	tab_es.className = 'tab_idiomas_off';
	tab_en.className = 'tab_idiomas_off';
	
	document.getElementById('div_content_info_'+lang).style.display = 'block';
	document.getElementById('td_idioma_'+lang).className = 'tab_idiomas_on';
}