<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-5659705-2']);
      _gaq.push(['_setDomainName', 'ilamarca.com']);
      _gaq.push(['_trackPageview']);
      (function() { var ga = document.createElement('script');
       ga.type = 'text/javascript';
       ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s); })();
    </script>
  </head>
  <body>
  	<div class="bg-content">
  		<div class="content clearfix">
        <div class="boton" style=" float: right; ">
          <form action="<?php echo url_for('home/setCulture') ?>" method="POST" id="form-culture">
          <a>
            <strong>
              PAIS: &nbsp;&nbsp;
              <?php echo select_tag('country', options_for_select(Country::getCultureForSelect(),$sf_user->getAttribute('true_culture','ar')), array('class'=>'et_input', 'style'=>'width: 145px;', 'id'=>'culture-id')) ?>
            </strong>
          </a>
          </form>
        </div>
        <br clear="all"/>
				<div class="header">
					<div class="logo"><a href="<?php echo url_for('@homepage') ?>"><img src="/images/logo_ilamarca.png" alt="Inmobiliaria Lamarca" /></a></div>
					<div class="submenu">
					<?php if ($sf_user->isAuthenticated()): ?>
						<div class="boton"><a href="<?php echo url_for('@profile') ?>" style="padding-top:5px;" class="et_link">Mi perfil</a></div>
						<div class="boton"><a href="<?php echo url_for('@logout') ?>" class="logout"></a></div>
					<?php else: ?>
						<div class="boton"><a href="<?php echo url_for('@loging') ?>" class="login"></a></div>
					<?php endif; ?>
            <div class="boton"><a href="<?php echo url_for('home/contact') ?>" class="contacto" ></a></div>
					<a href="https://www.facebook.com/pages/Inmobiliaria-Lamarca/127227613954322"  target="_blank" class="fb"></a>
					</div>
				</div>
    		<?php echo $sf_content ?>
    	</div>
    </div>
		<div class="footer">
			
		</div>
  </body>
</html>