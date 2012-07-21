<div class="content">
  <div class="leftside">
	  <h1 class="titulos">Detalles consulta del usuario &quot;<?php echo $data->AppUser->getName().' '.$data->AppUser->getLastName() ?>&quot;</h1>
	  <div style="height:5px;"></div>
	  <fieldset>
	  	<legend class="lg_separacion">Datos del cliente</legend>
	  	<table cellpadding="0" cellspacing="0">
	  		<tr>
	  			<td valign="top">
	  				<img src="/admin/<?php echo $data->AppUser->getPhoto() ? 'uploads/user/'.$data->AppUser->getPhoto() : 'images/no_user_b.jpg' ?>" border="0"/>
	  			</td><td width="20"></td>
	  			<td valign="top">
	  				<table cellpadding="3">
			  		<tr>
			  			<td width="70"><label>Dirección:</label></td>
			  			<td class="txt_show2"><?php echo $data->AppUser->getAddress() ? $data->AppUser->getAddress() : '---' ?></td>
			  		</tr>
			  		<tr>
			  			<td><label>Teléfono:</label></td>
			  			<td class="txt_show2"><?php echo $data->AppUser->getPhone() ? $data->AppUser->getPhone() : '---' ?></td>
			  		</tr>
			  		<tr>
			  			<td><label>Email:</label></td>
			  			<td class="txt_show2"><?php echo $data->AppUser->getEmail() ?></td>
			  		</tr>
	  				</table>
	  			</td>
	  		</tr>
	  	</table>
	  </fieldset>
	  <div style="height:5px;"></div>
	  <fieldset>
	  	<legend class="lg_separacion">Datos de la consulta</legend>
	  	<table cellpadding="3">
	  		<tr>
	  			<td width="120" valign="top"><label><strong>Comentarios:</strong></label></td>
	  			<td style="font-size:12px;"><?php echo nl2br($data->getComments()) ?></td>
	  		</tr>
	  		<tr><td height="5"></td></tr>
	  		<tr>
	  			<td valign="top"><label><strong>Sobre la propiedad:</strong></label></td>
	  			<td valign="top">
	  				<table cellpadding="0" cellspacing="0">
	  					<tr>
	  						<td><img src="<?php echo Gallery::getFirstGallery($data->RealProperty->getId()) ?>" border="0"/></td>
	  						<td valign="top" style="padding-left:20px;">
	  							<table cellpadding="0" cellspacing="0" style="font-size:12px;">
	  								<tr><td class="txt_show2"><?php echo $data->RealProperty->getName() ?></td></tr>
	  								<?php if ($data->RealProperty->getAddress()): ?>
		  								<tr><td height="5"></td></tr>
		  								<tr><td><?php echo nl2br($data->RealProperty->getAddress()) ?></td></tr>
	  								<?php endif; ?>
	  								<?php if ($data->RealProperty->Neighborhood->getName()): ?>
		  								<tr><td height="5"></td></tr>
		  								<tr><td><?php echo $data->RealProperty->Neighborhood->getName() ?></td></tr>
	  								<?php endif; ?>
	  								<tr><td height="15"></td></tr>
	  								<tr>
	  									<td>
	  										<a href="<?php echo 'http://'.$hostname.'/property?id='.$data->RealProperty->getId() ?>" target="_blank">
	  											Ver más info en la Web
	  										</a>
	  									</td>
	  								</tr>
	  							</table>
	  						</td>
	  					</tr>
	  				</table>
	  			</td>
	  		</tr>
	  	</table>
	  </fieldset>
	  <div style="height:5px;"></div>
	  <input type="button" value="Volver al listado" class="boton" onclick="document.location='<?php echo url_for('home/index') ?>';">
  </div>
  <div class="clear"></div>
</div>