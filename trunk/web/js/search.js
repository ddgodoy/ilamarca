function updCityList(geo_zone_id)
{
	var l_img = document.getElementById('img_loading');
	var s_url = document.getElementById('ajax_url_city').value;
	var s_lbl = document.getElementById('lbl_neighborhood').value;
  var s_class = $('#geo_zone').attr('class');

	l_img.style.visibility = 'visible';

	jQuery.ajax({
		type: 'POST',
		url: s_url,
		data: 'geo_zone='+geo_zone_id,
		success: function(data) {
			l_img.style.visibility = 'hidden';

      $('#div_sel_city').html(data);
      $('#city').attr('class',s_class);
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
	var s_class = $('#city').attr('class');

	l_img.style.visibility = 'visible';

	jQuery.ajax({
		type: 'POST',
		url: s_url,
		data: 'city='+city_id,
		success: function(data) {
			l_img.style.visibility = 'hidden';

	    $('#div_sel_neighborhood').html(data);
	    $('#neighborhood').attr('class',s_class);
		}
	});
}
//
function preserveSearchInDB()
{
	var sRef = '';
	var name = prompt('Puede ingresar una referencia para esta búsqueda', '');
	
	if (name != null) {
		sRef = escape(name);
	}
	var l_img = document.getElementById('img_rec_loading');
	var s_url = document.getElementById('ajax_url_rec_search').value;

	l_img.style.visibility = 'visible';

	jQuery.ajax({
		type: 'POST',
		url: s_url,
		data: 'name_ref='+sRef,
		success: function(data) {
			l_img.style.visibility = 'hidden';

			if (data != '') { alert(data); }
		}
	});
}