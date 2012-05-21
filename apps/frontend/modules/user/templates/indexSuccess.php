<div class="left">
	<div class="fondo-titulo contact">
		<div class="titulo"></div>
	</div>
	<?php if ($sf_user->getFlash('notice')): ?>
		<div class="mensajeSistema ok">Gracias por contactar con nosotros, Te responderemos a la brevedad</div>
		<br />
	<?php endif; ?>
	<div class="contacto">
            <div class="search_box clearfix no_background_image" style="margin-left: 35px">
			<form action="<?php url_for('user/index') ?>" method="post">
                            <table>
                                <tr>
                                    <td>
                                       <p><strong><?php echo $form['name']->renderLabel('* Nombre:') ?></strong></p>
					<?php
						$error_name = $form['name']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['name']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_name))
					?>
                                        <?php if ($form['name']->renderError()): ?><p style="color:red;"><?php echo strip_tags($form['name']->renderError()) ?></p><?php endif; ?>
                                    </td>
                                    <td>
                                        <p><strong><?php echo $form['last_name']->renderLabel('* Apellido:') ?></strong></p>
					<?php
						$error_last_name = $form['last_name']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['last_name']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_last_name))
					?>
                                        <?php if ($form['last_name']->renderError()): ?><p style="color:red;"><?php echo $form['last_name']->renderError() ?></p><?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><strong><?php echo $form['email']->renderLabel('* Email:') ?></strong></p>
					<?php
						$error_email = $form['email']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['email']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_email));
					?>
                                        <?php if ($form['email']->renderError()): ?><p style="color:red;"><?php echo $form['email']->renderError() ?></p><?php endif; ?>
                                    </td>
                                    <td>
                                        <p><strong><?php echo $form['re_email']->renderLabel('* Repetir Email:') ?></strong></p>
					<?php
						$error_re_email = $form['re_email']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['re_email']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_re_email));
					?>
                                        <?php if ($form['email']->renderError()): ?><p style="color:red;"><?php echo $form['email']->renderError() ?></p><?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><strong><?php echo $form['password']->renderLabel('* Contraseña:') ?></strong></p>
					<?php
						$error_password = $form['password']->renderError() ? 'background-color:#FFCCCC;' : '';
						echo $form['password']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_password));
					?>
                                        <?php if ($form['password']->renderError()): ?><p style="color:red;"><?php echo $form['password']->renderError() ?></p><?php endif; ?>
                                    </td>
                                    <td>
                                        <p><strong><?php echo $form['re_password']->renderLabel('* Repetir Contraseña:') ?></strong></p>
					<?php
                                                $error_re_password = $form['re_password']->renderError() ? 'background-color:#FFCCCC;' : '';
                                                echo $form['re_password']->render(array('class'=>'et_input','style'=>'width:255px;'.$error_re_password))
                                        ?>
                                        <?php if ($form['re_password']->renderError()): ?><p style="color:red;"><?php echo $form['re_password']->renderError() ?></p><?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                                <div class="rowElem">
                                    <p>
                                       <?php echo $form['captcha']->render(array('class'=>'et_input','style'=>'width:255px;'))  ?>
                                    </p>
                                </div>
				<?php echo $form->renderHiddenFields() ?>
				<p>Los campos con asterisco (*) son obligatorios</p>
				<div class="boton" style="bottom: 20px;">
					<input type="submit" value="" class="et_btn_buscar"/>
				</div>
			</form>
		</div>
        </div>
</div>
<!-- -->
<?php include_partial('home/right_static'); ?>