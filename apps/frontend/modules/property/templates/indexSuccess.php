<link rel="stylesheet" href="/css/lightbox/lightbox.css" type="text/css" media="screen" />
<script src="/js/lightbox/lightbox.js"></script>
<?php
	$m2_sup_cubierta = $property->getSquareMeters();
	$m2_sup_terreno  = $property->getCoveredArea();
	$get_google_map  = $property->getGoogleMap();
	$_down_pdf_file  = $property->getPdfFile();
?>
<script type="text/javascript">
	function asdfasdfas()
	{
		alert('okokok');
	}

	$(document).ready(function () {
		$('#fotos').click(function() {
			$('#gallery').removeAttr('style');
			$(this).attr('class', 'active-f');
			$('#videos').removeAttr('class');
			$('#videos').attr('class', 'videos');
			$('#gallery-videos').hide();
			$('#mapas').removeAttr('class');
			$('#mapas').attr('class', 'mapas');
			$('#gallery-mapas').hide();
		})
		//
		$('#videos').click(function() {
			$('#gallery-videos').removeAttr('style');
			$(this).attr('class', 'active-v');
			$('#fotos').removeAttr('class');
			$('#fotos').attr('class', 'fotos');
			$('#gallery').hide();
			$('#mapas').removeAttr('class');
			$('#mapas').attr('class', 'mapas');
			$('#gallery-mapas').hide();
			})
		//
		$('#mapas').click(function() {
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
		<h1><?php echo truncate_text($property->getName(), 55, '') ?></h1>
		<h3><?php echo Operation::getPrices($property->getId(), $sf_user->getCulture()) ?></h3>
	</div>
	<div id="container" class="cont-slider">
		<?php if ($_down_pdf_file): ?>
			<div class="pdf"><a href="<?php echo '/admin/uploads/pdf_file/'.$_down_pdf_file ?>" target="_blank"></a></div>
		<?php endif; ?>		
		<div class="tabs">
			<ul>
			  <li><a id="fotos" class="fotos active-f"></a></li>
			  <li><a id ="videos" class="videos"></a></li>
			  <li><a id="mapas" class="mapas"></a></li>
			</ul>
		</div>
		<div id="gallery" class="ad-gallery slider clearfix">
		<?php if (count($images) > 0): ?>
			<a href=""  rel="lightbox" id="mas-imagen" title="<?php echo $property->getName() ?>" class="ad-image-wrapper fotoBig"></a>
			<div class="ad-nav">
				<div class="ad-thumbs">
					<ul class="ad-thumb-list">
						<?php $index = 0; foreach ($images as $value):  ?>
						<li>
							<a href="<?php echo Gallery::getPath($value->getRealPropertyId()).$value->getInternalName() ?>">
	  						<img src="<?php echo Gallery::getPath($value->getRealPropertyId()).'c_'.$value->getInternalName() ?>" class="<?php echo 'image'.$index ?>">
							</a>
						</li>
						<?php $index++; endforeach; ?>
					</ul>
				</div>
			</div>
		<?php else: ?>
			<img src="/images/logo_ilamarca.png" border="0" style="margin-top:130px;"/>
		<?php endif; ?>
		</div>
		<div id="gallery-videos" class="slider clearfix" style="display:none;">
			<div class="fotoBig">
				<?php if ($videos): ?>
					<?php echo html_entity_decode($videos->getYoutube()) ?>
				<?php else: ?>
					<div style="margin-top:150px;color:#CCCCCC;">SIN VIDEO</div>
				<?php endif; ?>
			</div>
		</div>
		<div id="gallery-mapas" class="slider clearfix" style="display:none;">
			<div class="fotoBig">
				<?php if ($get_google_map): ?>
					<?php echo html_entity_decode($get_google_map) ?>
				<?php else: ?>
					<div style="margin-top:150px;color:#CCCCCC;">SIN MAPA DE GOOGLE</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="info">
		<h2>DETALLES GENERALES</h2>
		<ul>
			<?php if (!empty($m2_sup_cubierta)): ?>
				<li><strong>Superficie cubierta:</strong> <?php echo $m2_sup_cubierta ?> m2.</li>
			<?php endif; ?>
			<?php if (!empty($m2_sup_terreno)): ?>
				<li><strong>Superficie terreno: </strong> <?php echo $m2_sup_terreno ?> m2.</li>
			<?php endif; ?>
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