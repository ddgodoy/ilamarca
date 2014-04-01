<div class="left">
	<div class="fondo-titulo">
		<div class="titulo titulo-html"><p>CREÁ TU PERFIL</p></div>
	</div>
	<?php if ($sf_user->getFlash('notice')): ?>
		<div class="mensajeSistema ok">Gracias por contactar con nosotros. Te responderemos a la brevedad.</div>
		<br />
	<?php endif; ?>
	<div class="contacto">
		<div class="search_box clearfix" style="padding-top:90px;">
			<form action="<?php url_for('home/contact') ?>" method="post">
        <p><strong>Si ya creaste tu perfil ingresa tu datos!</strong></p>
        <br />
				<div class="rowElem">
					<p><strong><?php echo $form['email']->renderLabel('* Email:') ?></strong></p>
					<?php
						$error_email = $form['email']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['email']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_email));
					?>
          <?php if ($form['email']->renderError()): ?><p class="p-error"><em><?php echo '*'.strip_tags($form['email']->renderError()) ?></em></p><?php endif; ?>
				</div>
				<div class="rowElem">
					<p><strong><?php echo $form['password']->renderLabel('* Contraseña:') ?></strong></p>
					<?php
						$error_password = $form['password']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['password']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_password));
					?>
				</div>
				<?php echo $form->renderHiddenFields() ?>
				<p>Los campos con asterisco (*) son obligatorios</p>
				<div class="boton" style="top:280px;">
					<input type="submit" value="INGRESAR" class="et_btn_vacio"/>
				</div>
			</form>
      <br clear="all"/>
      <div style="margin-top:80px;">
      	<p>¿Ha olvidado la información de acceso? <a href="" class="a-intro">Click Aquí</a></p>
      </div>
		</div>
		<div class="divider"></div>
		<div class="info register" style="margin-top: 80px">
                    <p><strong>Regístrate</strong></p>
                    <p>Si todavía no creaste tu perfil ingresa aquí!</p>
                    <div class="boton" style="top:180px;">
                      <input type="button" value="REGISTRO" onclick="document.location='<?php echo url_for('user/index') ?>';" class="et_btn_vacio"/>
                    </div>
		</div>
	</div>
</div>
<?php include_partial('home/right_static'); ?>