<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAHhzikxCQyRAS8ryQoB75mRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxQiqBRnE1Iky5sZfKGxzYbUanZ0HA" type="text/javascript"></script>  
<script type="text/javascript">
    $('docuemnt').ready(function(){
        
         $('#btn_google_maps').click(function(){
            var address     = $('#address').val();
            var number      = $('#number').val();
            var geo_zone    = $('#select_geo_zone option:selected').html();
            var country     = 'Argentina'; 
            var url         = '<?php echo url_for('@property-ajax-location') ?>';
            var name        = $('#real_property_es_name').val(); 
            if(address !== '' && number !== '')
            {
                $('#img_loading_google').show();
                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    data: 'address='+address+'&number='+number+'&geo_zone='+geo_zone+'&country='+country,
                    success: function(json_string) {
                        var data = eval("(" + json_string + ")")
                        $('#img_loading_google').hide();
                        $('#map').show();
                        $('#latitude').val(data.lat);
                        $('#longitude').val(data.longt);
                        $('#map').html(inicializar(data.lat,data.longt, name));
                    }
                })    
            }
            
        });
        
    });
    
    function inicializar(lat, longt, name) {  
        if (GBrowserIsCompatible()) 
        {  

            var map = new GMap2(document.getElementById("map"));  
            map.setCenter(new GLatLng(lat,longt), 15);  
            map.addControl(new GMapTypeControl());  
            map.addControl(new GLargeMapControl());  
            map.addControl(new GScaleControl());  
            map.addControl(new GOverviewMapControl());  
            //map.addOverlay(new GMarker(new GLatLng(-33.43795,-70.603627)));  

            var show_descripcion = '<b>'+name+'</b><br />';
            var point = new GPoint (longt,lat);
            var marker = new GMarker(point);
            map.addOverlay(marker);
            marker.openInfoWindowHtml(show_descripcion);

            GEvent.addListener(map, "click", function (overlay,point){
               if (point){
                   marker.setPoint(point);
                   map.addOverlay(marker);
                   marker.openInfoWindowHtml(show_descripcion);
                   $('#latitude').val(point.lat());
                   $('#longitude').val(point.lng());
               }
            });      
        }    
    }  
</script>
