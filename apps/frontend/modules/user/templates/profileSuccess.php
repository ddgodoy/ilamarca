<div class="left">
    <?php if($sf_user->getFlash('notice')): ?>
     <div class="mensajeSistema comun"><ul><li><?php echo $sf_user->getFlash('notice') ?></li></ul></div>
    <br/>
    <?php endif; ?>
	<div class="resultado perfil">
		<div class="fondo-titulo" style="height:47px;">
			<div class="titulo"></div>
		</div>
		<?php if (count($searchs) > 0): ?>
		<table style="font-family:arial;font-size:13px;" width="100%" cellpadding="0" cellspacing="0">
			<tr bgcolor="#FFFFFF">
				<th style="text-align:left;padding:5px;">Fecha</th>
				<th style="text-align:left;">Referencia</th>
				<th style="text-align:left;">Criterios</th>
			</tr>
			<?php foreach ($searchs as $sch): $_infoFromDB = SearchProfile::getStringInfroFromDBObject($sch); ?>
			<tr>
				<td style="padding:5px;"><?php echo Common::getFormattedDate($sch->getCreatedAt(), 'd/m/Y H:i') ?></td>
				<td>
					<a href="<?php echo url_for('search/index').$_infoFromDB['query_string'] ?>" title="Ver resultados de esta búsqueda" class="et_link">
						<?php echo $sch->getName() ?>
					</a>
				</td>
				<td><?php echo $_infoFromDB['criterios'] ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php else: ?>
			<div class="mensajeSistema comun"><ul><li>No hay búsquedas registradas</li></ul></div>
		<?php endif; ?>
	</div>
</div>
<!--  -->
<div class="right">
	<div class="box clearfix wprofile">
		<div class="inner clearfix">
			<div class="titulo"><img src="/images/tit_misdatos.png" alt="Mis datos de perfil" /></div>
			<div class="avatar">
              <img alt="Avatar" src="<?php echo $sf_user->getAttribute('user_photo')!='' ? '/admin/uploads/user/'.$sf_user->getAttribute('user_photo') : '/images/avatar.jpg' ?>" border="0" width="137px" height="119px"/>
            </div>
			<div class="nombre"><?php echo $oUser->getName().' '.$oUser->getLastName() ?></div>

			<p class="label">Dirección:</p>
			<p><?php echo $oUser->getAddress() ?></p>
			<p class="label">Teléfono:</p>
			<p><?php echo $oUser->getPhone() ?></p>
			<p class="label">E-mail:</p>
			<p><?php echo $oUser->getEmail() ?></p>

			<div class="boton">
				<a href="#" class="modificar" onclick="document.location='<?php echo url_for('user/updateProfile') ?>';"></a>
			</div>
		</div>
	</div>
	<div class="sombra"></div>
</div>