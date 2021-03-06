<div class="content">
  <div class="leftside">
	  <h1 class="titulos">Detalles de la búsqueda &quot;<?php echo $data->getName() ?>&quot;</h1>
	  <div style="height:5px;"></div>
	  <fieldset>
	  	<legend class="lg_separacion">Datos de la búsqueda</legend>
	  	<table cellpadding="3">
	  		<tr>
	  			<td width="70"><label>Fecha:</label></td>
	  			<td class="txt_show2"><?php echo Common::getFormattedDate($data->getCreatedAt(), 'd/m/Y H:i') ?></td>
	  		</tr>
	  		<tr>
	  			<td><label>Criterios:</label></td>
	  			<td class="txt_show2"><?php echo $perfil['criterios'] ?></td>
	  		</tr>
	  	</table>
	  </fieldset>
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
			  			<td width="70"><label>Nombre:</label></td>
			  			<td class="txt_show2"><?php echo $data->AppUser->getName().' '.$data->AppUser->getLastName() ?></td>
			  		</tr>
			  		<tr>
			  			<td><label>Dirección:</label></td>
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
	  	<legend class="lg_separacion">Propiedades en la búsqueda</legend>
	  	<table width="100%" cellspacing="0" border="0" class="listados">
		    <tr>
		      <th width="30%" align="left">Nombre</th>
		      <th width="15%" align="left">Tipo de propiedad</th>
		      <th width="20%" align="left">Barrio</th>
		      <th width="30%" align="left">Dirección</th>
		      <th width="5%" style="text-align:center;">Opciones</th>
		    </tr>
		    <?php foreach ($propts as $item): ?>
		    <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
		      <td style="padding:4px;"><?php echo $item->getName() ?></td>
		      <td style="padding:4px;"><?php echo $item->PropertyType->getName() ?></td>
		      <td style="padding:4px;"><?php echo $item->Neighborhood->getName() ?></td>
		      <td style="padding:4px;"><?php echo $item->getAddress() ?></td>
		      <td style="padding:4px;text-align:center;">
		      	<a href="<?php echo 'http://'.$hostname.'/property?id='.$item->getId() ?>" title="Ver detalle en la Web" target="_blank"><img src="/admin/images/icon_company.jpg" border="0"/></a>
		      </td>
		    </tr>
		    <?php endforeach; ?>
			</table>
	  </fieldset>
	  <div style="height:5px;"></div>
	  <input type="button" value="Volver al listado" class="boton" onclick="document.location='<?php echo url_for('home/index') ?>';">
  </div>
  <div class="clear"></div>
</div>