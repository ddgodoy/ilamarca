<div class="left">
	<div class="resultado perfil">
		<div class="fondo-titulo" style="height:47px;">
			<div class="titulo"></div>
		</div>
		<table style="font-family:arial;font-size:13px;" width="100%" cellpadding="2">
			<tr>
				<th style="text-align:left;">Fecha</th>
				<th style="text-align:left;">Referencia</th>
				<th style="text-align:left;">Criterios</th>
			</tr>
			<?php foreach ($searchs as $sch): $_infoFromDB = SearchProfile::getStringInfroFromDBObject($sch); ?>
			<tr>
				<td><?php echo Common::getFormattedDate($sch->getCreatedAt(), 'd/m/Y H:i') ?></td>
				<td>
					<a href="<?php echo url_for('search/index').$_infoFromDB['query_string'] ?>" title="Ver resultados de esta búsqueda">
						<?php echo $sch->getName() ?>
					</a>
				</td>
				<td><?php echo $_infoFromDB['criterios'] ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
<!--  -->
<div class="right">
	<div class="box clearfix wprofile">
		<div class="inner clearfix">
			<div class="titulo"><img src="/images/tit_misdatos.png" alt="Mis datos de perfil" /></div>
			<div class="avatar"><img src="/images/avatar.jpg" alt="Avatar generico" /></div>
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