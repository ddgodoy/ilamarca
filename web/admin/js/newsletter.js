function addToNewsCart(property_id)
{
	var s_url = document.getElementById('cart_url').value;

	jQuery.ajax({
		type: 'POST',
		url: s_url,
		data: 'property_id='+property_id,
		success: function(data)
		{
			var upd_news_cant = 'Propiedades para newsletter [' + data + ']';
			$('#btn_cant_news').val(upd_news_cant);
			$('#hidden_cant_incart').val(data);
		}
	});
}
//
function gotoNewsletterList()
{
	var cantidad = document.getElementById('hidden_cant_incart').value;
	
	if (cantidad > 0) {
		var s_url = document.getElementById('cart_list').value;

		document.location = s_url;
	}
}