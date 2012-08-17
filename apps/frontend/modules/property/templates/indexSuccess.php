<script type="text/javascript">
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
  //
  $(window).resize(function () {
      var ancho = 735;
      var alto = 475;
      var wscr = $(window).width();
      var hscr = $(window).height();
      $('#bgtransparent').css("width", wscr);
      $('#bgtransparent').css("height", hscr);
      $('#bgmodal').css("width", ancho + 'px');
      $('#bgmodal').css("height", alto + 'px');
      var wcnt = $('#bgmodal').width();
      var hcnt = $('#bgmodal').height();
      var mleft = (wscr - wcnt) / 2;
      var mtop = (hscr - hcnt) / 2;
      var atop = (mtop - 15);
      var aright = (mleft - 72);
      $('#bgmodal').css("left", mleft + 'px');
      $('#bgmodal').css("top", mtop + 'px');
      $('#modal-close').css("top", atop + 'px');
      $('#modal-close').css("right", aright + 'px')
  });
  $('#email-box').click(function(){
     showModal();
  });
  $('#submit-sharer').click(function() {

    if ($('#contac_name').val()=='')
    {
      alert('Ingresa tu nombre');
      $('#contac_name').focus();
      return false;
    }
    if ($('#contac_email').val()=='')
    {
      alert('Ingresa tu email');
      $('#contac_email').focus();
      return false;
    }
    if (!validar_email($('#contac_email').val()))
    {
      alert('Tu email no es correcto');
      $('#contac_email').focus();
      return false;
    }
    if ($('#contac_email_friend').val()=='')
    {
      alert('Ingresa el email de tu amigo');
      $('#contac_email_friend').focus();
      return false;
    }
    if (!validar_email($('#contac_email_friend').val()))
    {
      alert('El email de tu amigo no es correcto');
      $('#contac_email_friend').focus();
      return false;
    }
  });
});
//
function showModal() {
    var bgdiv = $('<div>').attr({
        'id': 'bgtransparent'
    });
    $('body').append(bgdiv);
    var wscr = $(window).width();
    var hscr = $(window).height();
    $('#bgtransparent').css("width", wscr);
    $('#bgtransparent').css("height", hscr);
    var moddiv = '';
    moddiv = $('<div>').attr({
        'id': 'bgmodal'
    });
    var mod_close = $('<div>').attr({
        id: 'modal-close-div'
    });
    $('body').append(moddiv);
    $('body').append(mod_close);
    $('#bgmodal').append($('#ab-inbox').contents());
    $('#modal-close-div').append($('#new-close-modal').contents());
    $(window).resize()
}
//
function closeModal()
{
  $('#ab-inbox').append($('#bgmodal').contents());
  $('#new-close-modal').append($('#modal-close-div').contents());
  $('#bgmodal').remove();
  $('#bgtransparent').remove();
  $('#modal-close-div').remove()
}
//
function validar_email(valor)
{
  // creamos nuestra regla con expresiones regulares.
  var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
  // utilizamos test para comprobar si el parametro valor cumple la regla
  if (filter.test(valor))
    return true;
  else
    return false;
}
</script>
<?php include_partial ('boxEmailSharer') ?>
<div class="left ficha">
    <?php if($sf_user->getFlash('notice')): ?>
     <div class="mensajeSistema comun"><ul><li><?php echo $sf_user->getFlash('notice') ?></li></ul></div>
    <br/>
    <?php endif; ?>
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
			<a href=""  rel="lightbox[$ID]" id="mas-imagen" title="<?php echo $property->getName() ?>" class="ad-image-wrapper fotoBig"></a>
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
            <?php if (!empty($years_antiquity)): ?>
				<li><strong>Antigüedad (años): </strong> <?php echo $years_antiquity ?> </li>
			<?php endif; ?>
            <?php if (!empty($qty_bathrooms)): ?>
				<li><strong>Baños: </strong> <?php echo $qty_bathrooms ?> </li>
			<?php endif; ?>
			<li><strong>Cantidad dormitorios: </strong> <?php echo $property->getBedroom()->getName() ?></li>
		</ul>
        <?php if($property->getDetail()): ?>
		<h2>DESCRIPCIÓN</h2>
		<p style="text-align:justify">
			<?php echo nl2br($property->getDetail()) ?>
		</p>
    <br/>
    <?php endif; ?>
    <?php if($property->getPointsOfRef()): ?>
    <h2>PUNTOS DE REFERENCIA</h2>
		<p style="text-align:justify">
			<?php echo nl2br($property->getPointsOfRef()) ?>
		</p>
    <br/>
    <?php endif; ?>
    <?php if($property->getTransports()): ?>
    <h2>TRANSPORTE</h2>
		<p style="text-align:justify">
			<?php echo nl2br($property->getTransports()) ?>
		</p>
    <br/>
    <?php endif; ?>
	</div>
</div>
<!-- -->
<div class="right">
	<div class="box clearfix wprofile">
		<div class="inner clearfix">
			<div class="titulo"><img src="images/tit_datosvendedor.png" alt="Datos del vendedor" /></div>
            <div class="avatar" align="center" style="margin-left: 70px"><img src="<?php echo $property->AppUser->getPhoto() ? '/admin/uploads/user/'.$property->AppUser->getPhoto() : '/images/avatar.jpg' ?>" /></div>
            <br clear="all"/>
			<div class="nombre" style="margin-left: 25px; width: 85%; padding-top: 15px;">Nombre: <?php echo ucwords($property->AppUser->getName().' '.$property->AppUser->getLastName()) ?></div>
            <div class="nombre" style="margin-left: 25px; width: 85%">Teléfono: <?php echo $property->AppUser->getPhone()?$property->AppUser->getPhone():'---' ?></div>
            <div class="nombre" style="margin-left: 25px; width: 85%">Email: <?php echo $property->AppUser->getEmail() ?></div>
			<div class="boton">
				<a href="<?php echo $sf_user->isAuthenticated() ? url_for('search/contact?pid='.$property->getId()) : url_for('user/index') ?>" class="contactar" style="margin-top:30px;"></a>
			</div>
		</div>
	</div>
	<div class="sombra"></div>
	<!-- -->
  <?php if (!empty($qrcode_img)): ?>
  <div class="box clearfix wprofile">
    <div align="center" style=" padding: 15px;">
			<img src="/uploads/qr_codes/<?php echo $qrcode_img ?>" alt="qr" title="qr" />
    </div>
	</div>
	<div class="sombra"></div>
	<!-- -->
    <?php endif; ?>
	<div class="box clearfix  compartir">
		<div class="inner clearfix">
			<div class="titulo"><img src="images/tit_compartir.png" alt="Compartir propiedad" /></div>
			<div class="boton">
        <a href="http://www.facebook.com/sharer.php?u=<?php echo $url_site ?>" class="share-fb" target="_blanck">En Facebook</a>
        <a class="share-email" id="email-box" >Por E-mail</a>
			</div>
		</div>
	</div>
	<div class="sombra"></div>
	<!--	-->
	<?php include_partial('home/rateProperty') ?>
</div>