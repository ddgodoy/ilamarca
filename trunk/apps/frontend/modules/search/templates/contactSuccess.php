<div class="left">
	<div class="fondo-titulo contact">
		<div class="et_search_contacto">Contacto para más información</div>
	</div>
	<?php if ($messg): ?>
		<div class="mensajeSistema ok">Gracias por contactar con nosotros. Responderemos a la brevedad.</div>
		<br />
	<?php endif; ?>
	<div class="contacto">
		<div class="search_box clearfix" style="padding-top:10px;">
			<form action="<?php url_for('search/contact') ?>" method="post">
				<div class="rowElem">
					<p style="padding-bottom:5px;"><strong>* Comentarios:</strong></p>
					<textarea class="et_input" name="p_comments" style="width:300px;height:270px;"><?php echo $commt ?></textarea>
				</div>
				<p <?php if ($error): ?>style="color:red;"<?php endif; ?>>Los campos con asterisco (*) son obligatorios</p>
				<div class="boton" style="bottom: 20px;">
					<input type="submit" value="ENVIAR" class="et_btn_vacio"/>
					<input type="hidden" name="pid" value="<?php echo $pid ?>" />
				</div>
			</form>
		</div>
		<div class="divider"></div>
		<div class="et_info_casa">
			<table width="100%" border="0" style="font-family:arial;font-size:14px;">
				<tr><td height="10"></td></tr>
				<tr>
					<td style="text-align:center;color:#333333;"><strong><?php echo $obj->getName() ?></strong></td>
				</tr>
				<tr><td height="10"></td></tr>
				<tr>
					<td style="text-align:center;">
						<a href="<?php echo url_for('property/index?id='.$obj->getId()) ?>">
							<img src="<?php echo Gallery::getFirstGallery($obj->getId()) ?>" alt="<?php echo $obj->getName() ?>" border="0"/>
						</a>
					</td>
				</tr>
				<tr><td height="15"></td></tr>
				<tr><td style="color:#333333;font-size:13px;"><?php echo $obj->getAddress() ?></td></tr>
			</table>
		</div>
	</div>
</div>
<?php include_partial('home/right_static') ?>