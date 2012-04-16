<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <script language="javascript">
			$(function(){
				$('form').jqTransform({imgPath:'jqtransformplugin/img/'});
			});
		</script>
  </head>
  <body>
  	<div class="bg-content">
  		<div class="content clearfix">
				<div class="header">
					<div class="logo"><a href="#"><img src="/images/logo_ilamarca.png" alt="Inmobiliaria Lamarca" /></a></div>
					<div class="submenu">
					<div class="boton"><a href="" class="login"></a></div>
					<div class="boton"><a href="" class="logout"></a></div>
					<div class="boton"><a href="" class="contacto"></a></div>
					<a href="https://www.facebook.com/inmobiliaria.lamarca"  target="_blank" class="fb"></a>
					</div>
				</div>
    		<?php echo $sf_content ?>
    	</div>
    </div>
		<div class="footer">
			<p>
				<span>Inmobiliaria Lamarca</span>
				<span class="line">|</span>
				Tel/Fax: 0351 4824473
				<span class="line">|</span>
				Av. Lamarca 3920 - Barrio Urca - (5009) Córdoba, Argentina
			</p>
		</div>
  </body>
</html>