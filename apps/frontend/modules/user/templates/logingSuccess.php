<div class="left">
	<div class="fondo-titulo">
		<div class="titulo titulo-html">
                    <p>CREÁ TU PERFIL</p>
                </div>
	</div>
	<?php if ($sf_user->getFlash('notice')): ?>
		<div class="mensajeSistema ok">Gracias por contactar con nosotros, Te responderemos a la brevedad</div>
		<br />
	<?php endif; ?>
	<div class="contacto">
		<div class="search_box clearfix" style="padding-top:10px;">
			<form action="<?php url_for('home/contact') ?>" method="post">
				<div class="rowElem">
					<p><strong><?php echo $form['email']->renderLabel('* Email:') ?></strong></p>
					<?php
						$error_email = $form['email']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['email']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_email));
					?>
				</div>
				<div class="rowElem">
					<p><strong><?php echo $form['password']->renderLabel('* Contraseña:') ?></strong></p>
					<?php
						$error_password = $form['password']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['password']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_password));
					?>
				</div>
				<?php echo $form->renderHiddenFields() ?>
				<p <?php if ($form->hasErrors()): ?>style="color:red;"<?php endif; ?>>Los campos con asterisco (*) son obligatorios</p>
				<div class="boton" style="bottom: 20px;">
					<input type="submit" value="" class="et_btn_buscar"/>
				</div>
			</form>
		</div>
		<div class="divider"></div>
		<div class="info">
			<p>
				<strong>Inmobiliaria Lamarca</strong><br />
				Av. Lamarca 3920 - Barrio Urca<br />
				Córdoba (5009) Argentina. <br />
				Tel/Fax: 0351- 4824473
			</p>
			<p>
				<strong>Matías</strong><br />
				Cel: 0351- 153290796 <br />
				E-mail: <a href="mailto:matias@inmobiliarialamarca.com">matias@inmobiliarialamarca.com</a>
			</p>
			<p>
				<strong>Luciana</strong><br />
				Cel: 0351- 153290794 <br />
				E-mail: <a href="mailto:luciana@inmobiliarialamarca.com">luciana@inmobiliarialamarca.com</a>
			</p>
		</div>
	</div>
</div>
<!-- -->
<?php include_partial('home/right_static'); ?>
