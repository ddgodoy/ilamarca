<script>
$(document).ready(function () {
  $('#fotos').click(function(){
      $('#gallery').removeAttr('style');
      $(this).attr('class', 'active-f');
      $('#videos').removeAttr('class');
      $('#videos').attr('class', 'videos');
      $('#gallery-videos').hide();
      $('#mapas').removeAttr('class');
      $('#mapas').attr('class', 'mapas');
      $('#gallery-mapas').hide();
  })

  $('#videos').click(function(){
      $('#gallery-videos').removeAttr('style');
      $(this).attr('class', 'active-v');
      $('#fotos').removeAttr('class');
      $('#fotos').attr('class', 'fotos');
      $('#gallery').hide();
      $('#mapas').removeAttr('class');
      $('#mapas').attr('class', 'mapas');
      $('#gallery-mapas').hide();
  })

  $('#mapas').click(function(){
      $('#gallery-mapas').removeAttr('style');
      $(this).attr('class', 'active-m');
      $('#fotos').removeAttr('class');
      $('#fotos').attr('class', 'fotos');
      $('#gallery').hide();
      $('#videos').removeAttr('class');
      $('#videos').attr('class', 'videos');
      $('#gallery-videos').hide();
  })

});
</script>
<div class="left ficha">
	<div class="fondo-titulo">
		<h1><?php echo $property->getName()  ?></h1>
		<h3><?php echo Operation::getPrices($property->getId(), $sf_user->getCulture()) ?></h3>
	</div>
	<div id="container" class="cont-slider">
            <div class="pdf"><a href="#"></a></div>
            <div class="tabs">
                    <ul>
                            <li><a id="fotos" class="fotos active-f" title="fotos"></a></li>
                            <li><a id ="videos" class="videos" title="videos"></a></li>
                            <li><a id="mapas" class="mapas" title="mapas"></a></li>
                    </ul>
            </div>
            
            <div id="gallery" class="ad-gallery slider clearfix">
              <?php if(count($images)>0): ?>
              <div class="ad-image-wrapper fotoBig">
              </div>
              <div class="ad-nav">
                <div class="ad-thumbs">
                  <ul class="ad-thumb-list">
                    <?php $index = 0 ?>
                    <?php foreach ($images as $value):  ?>
                    <li>
                      <a href="<?php echo Gallery::getPath($value->getRealPropertyId()).$value->getInternalName() ?>">
                          <img src="<?php echo Gallery::getPath($value->getRealPropertyId()).'c_'.$value->getInternalName() ?>" class="<?php echo 'image'.$index ?>">
                      </a>
                    </li>
                    <?php $index++; ?>
                    <?php endforeach ?>
                  </ul>
                </div>
              </div>
              <?php endif; ?>
            </div>
            
            <div id="gallery-videos" class="slider clearfix" style="display: none">
                <div class="fotoBig">
                    <?php echo html_entity_decode($videos->getYoutube()) ?>
                </div>
            </div>
            <div id="gallery-mapas" class="slider clearfix" style="display: none">
                <div class="fotoBig">
                    <?php echo html_entity_decode($property->getGoogleMap()) ?>
                </div>
            </div>
	</div>
	<div class="info">
		<h2>DETALLES GENERALES</h2>
		<ul>
			<li><strong>Superficie cubierta:</strong>  <?php echo $property->getSquareMeters() ?> m2.</li>
			<li><strong>Superficie terreno: </strong> <?php echo $property->getCoveredArea() ?> m2.</li>
			<li><strong>Cantidad dormitorios: </strong> <?php echo $property->getBedroom()->getName() ?></li>
		</ul>
		<h2>DESCRIPCIÓN</h2>
                <p style="text-align:justify">
			<?php echo $property->getDetail() ?>
		</p>
	</div>
</div>
<!-- -->
<div class="right">
	<div class="box clearfix wprofile">
		<div class="inner clearfix">
			<div class="titulo"><img src="images/tit_datosvendedor.png" alt="Datos del vendedor" /></div>
			<div class="avatar"><img src="images/avatar.jpg" alt="Avatar generico" /></div>
			<div class="nombre">Juan Gutierrez</div>
			<p class="label">Dirección:</p>
			<p>Av. Emilio Lamarca 3920</p>
			<p class="label">Teléfono:</p>
			<p>0351 42824473</p>
			<p class="label">E-mail:</p>
			<p>juangutierrez@gmail.com</p>
			<div class="boton"><a href="#" class="contactar"></a></div>
		</div>
	</div>
	<div class="sombra"></div>
	<!-- -->
	<div class="box clearfix  compartir">
		<div class="inner clearfix">
			<div class="titulo"><img src="images/tit_compartir.png" alt="Compartir propiedad" /></div>
			<div class="boton">
				<a href="#" class="share-fb">En Facebook</a>
				<a href="#" class="share-email">Por E-mail</a>
			</div>  
		</div>
	</div>
	<div class="sombra"></div>
	<!--	-->
	<div class="box clearfix">
		<div class="inner clearfix">
			<div class="titulo"><img src="images/tit_tasa.png" alt="Tasá tu propiedad" /></div>
			<p>
				¿Querés vender o alquilar tu casa?<br />
				Te brindamos la seguridad de un <strong>Perito Tasador Oficial.</strong>
			</p>
			<div class="boton">
				<a href="#" class="vende"></a>
				<a href="#" class="alquila"></a>
			</div>
		</div>
	</div>
	<div class="sombra"></div>
</div>