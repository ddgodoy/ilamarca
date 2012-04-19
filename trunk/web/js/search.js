function updCityList(geo_zone_id)
{
	var l_img = document.getElementById('img_loading');
	var s_url = document.getElementById('ajax_url_city').value;
	var s_lbl = document.getElementById('lbl_neighborhood').value;

	l_img.style.visibility = 'visible';

	jQuery.ajax({
		type: 'POST',
		url: s_url,
		data: 'geo_zone='+geo_zone_id,
		success: function(data) {
			l_img.style.visibility = 'hidden'; $('#div_sel_city').html(data);
		}
	});
	var sel_neighborhood = document.getElementById('neighborhood');

	sel_neighborhood.options.length = 0;
	sel_neighborhood[0] = new Option(s_lbl, '0');
	sel_neighborhood[0].selected = true;
}
//
function updNeighborhoodList(city_id)
{
	var l_img = document.getElementById('img_loading');
	var s_url = document.getElementById('ajax_url_neighborhood').value;

	l_img.style.visibility = 'visible';

	jQuery.ajax({
		type: 'POST',
		url: s_url,
		data: 'city='+city_id,
		success: function(data) {
			l_img.style.visibility = 'hidden'; $('#div_sel_neighborhood').html(data);
		}
	});
}