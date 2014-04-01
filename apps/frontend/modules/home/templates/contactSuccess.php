<div class="left">
     <?php if($type == ''): ?>
        <div class="fondo-titulo contact">
          <div class="titulo"></div>
        </div>
     <?php else: ?>
        <div class="fondo-titulo">
          <div class="titulo titulo-html"><p>TASA TU PROPIEDAD</p></div>
        </div>
     <?php endif; ?>
	<?php if ($sf_user->getFlash('notice')): ?>
		<div class="mensajeSistema ok">Gracias por contactar con nosotros. Te responderemos a la brevedad.</div>
		<br />
	<?php endif; ?>
	<div class="contacto">
		<div class="search_box_not_background clearfix" style="padding-top:10px;<?php if($perfil!=''): ?> padding-right: 38px<?php endif; ?>">
            <form action="<?php url_for('home/contact') ?>" method="post" enctype="multipart/form-data">
				<div class="rowElem">
					<p><strong><?php echo $form['name']->renderLabel('* Nombre y Apellido:') ?></strong></p>
					<?php
						$error_name = $form['name']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['name']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_name))
					?>
				</div>
				<div class="rowElem">
					<p><strong><?php echo $form['email']->renderLabel('* Email:') ?></strong></p>
					<?php
						$error_email = $form['email']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['email']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_email));
					?>
				</div>
				<div class="rowElem">
					<p><strong><?php echo $form['phone']->renderLabel('* Teléfono:') ?></strong></p>
					<?php
						$error_phone = $form['phone']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['phone']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_phone));
					?>
				</div>
                <?php if($perfil==''): ?>
				<div class="rowElem">
					<p><strong><?php echo $form['address']->renderLabel('Dirección:') ?></strong></p>
					<?php echo $form['address']->render(array('class'=>'et_input','style'=>'width:255px;')) ?>
				</div>
                <?php else: ?>
                <div class="rowElem">
                  <p <?php echo !empty($error_file)?'style="color: red;"':''; ?> ><strong>* CV:</strong> <em>(.doc / .pdf)</em></p>
					<?php echo input_file_tag('cv', array('class'=>'et_input','style'=>'width:255px;')) ?>
				</div>
                <?php endif; ?>
				<div class="rowElem">
					<p><strong><?php echo $form['message']->renderLabel('* '.$label.':') ?></strong></p>
					<?php
						$error_message = $form['message']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['message']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_message));
					?>
				</div>
                                <br/>
                                <div class="rowElem" style=" width: 320px">
                                    <?php  echo $form['captcha']->render(array('class'=>'et_input','style'=>'width:255px;'))  ?>
                                    <?php if ($form['captcha']->renderError()): ?><p class="p-error"><em><?php echo '*'.strip_tags($form['captcha']->renderError()) ?></em></p><?php endif;?>
                               </div>
				<?php echo $form->renderHiddenFields() ?>
                <?php if(!empty($error_file)): ?>
                <p style="color:red;">(*) Formato de archivo incorrecto</p>
                <?php else: ?>
				<p <?php if ($form->hasErrors()): ?>style="color:red;"<?php endif; ?>>Los campos con asterisco (*) son obligatorios</p>
                <?php endif; ?>
                                <div class="boton" style="bottom: 25px">
					<input type="submit" value="ENVIAR" class="et_btn_vacio"/>
				</div>
			</form>
		</div>
		<div class="divider"></div>
		<div class="info">
			<p>
				<strong>ilamarca.com</strong><br />
				Av. Lamarca 3920 Barrio Urca.<br/>
                Córdoba (5009) Argentina.<br />
			</p>
			<p>
				<strong>Matías (Argentina)</strong><br />
				Celular desde Argentina: 0351-153290796 <br />
                Mobile from Outside: (+54) 9 351 3290796<br/>
                Skype: inmobiliaria.lamarca<br/>
                E-mail: <a href="mailto:matias@ialamarca.com">matias@ilamarca.com</a><br/>
			</p>
			<p>
				<strong>Luciana (Estados Unidos)</strong><br />
				Mobile: +1 6105974495 <br />
                Skype: lucaballero26<br/>
				E-mail: <a href="mailto:luciana@ilamarca.com">luciana@ilamarca.com</a>
			</p>
		</div>
	</div>
</div>
<?php include_partial('right_static'); ?>