//
function handleListas(sl_origen, sl_destino)
{
	var origen  = document.getElementById(sl_origen);
	var destino = document.getElementById(sl_destino);
	var go_move = false;
	var reorder = false;
	var a_clear = new Array();

	if (origen.length > 0)
	{
		var c = 0;

		for (var i=0; i < origen.length; i++)
		{
			if (origen[i].selected)
			{
				go_move = puedeMoverse(origen[i].value, destino);

				if (go_move) {
					destino.options[destino.options.length] = new Option(origen[i].text, origen[i].value, false, false);
					reorder = true;
				}
				if (sl_origen == 'selected_zones' || go_move) {
					a_clear[c] = origen[i].value; c++;
				}
			}
		}
		// clear movidos
		for (var j=0; j < a_clear.length; j++)
		{
			for (var k=0; k < origen.length; k++) {
				if (origen[k].value == a_clear[j]) { origen.options[k] = null; break; }
			}
		}
	}
	reordenarListaBarrios(reorder);
}
//
function reordenarListaBarrios(reorder)
{
	if (reorder) {
		var to_sort = new Array();
		var barrios = document.getElementById('neighborhood');

		if (barrios.length > 0) {
			for (var i=0; i < barrios.length; i++) {
				to_sort[i] = { "indice": barrios[i].value, "texto": barrios[i].text };
			}
			to_sort.sort(sort_by('indice', 0, parseInt));

			barrios.options.length = 0;

			for (var i=0; i < to_sort.length; i++) {
				barrios.options[barrios.options.length] = new Option(to_sort[i].texto, to_sort[i].indice, false, false);
			}
		}
	}
}
//
function puedeMoverse(value_origen, destino)
{
	for (var i=0; i < destino.length; i++) {
		if (destino[i].value == value_origen) { return false; }
	}
	return true;
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
      $('#div_sel_city').html(data); updNeighborhoodList(0)
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
function prepareSelectMultiple()
{
	var seleccionados = document.getElementById('selected_zones');

	for (var i=0; i < seleccionados.length; i++) {
		seleccionados.options[i].selected = true;
	}
	return true
}