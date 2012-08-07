<div class="content">
<?php if ($qContacts > 0 || $qSearchs > 0): ?>
	<div class="columnas col2" style="width:98%;">
		<div class="paneles" style="width:47%;height:400px;float:left;overflow:auto;">
			<h1>Contactos desde la Web</h1>
			<?php if ($qContacts > 0): ?>
			<table width="100%" cellspacing="0" border="0" class="listados">
		    <tr>
		      <th width="20%" align="left">Fecha</th>
		      <th width="30%" align="left">Usuario</th>
		      <th width="37%" align="left">Propiedad</th>
		      <th width="13%" style="text-align:center;" colspan="2">Opciones</th>
		    </tr>
		    <?php foreach ($contacts as $citem): ?>
		    	<tr class="<?php if (!empty($odd1)) { echo 'gris'; $odd1=0; } else { echo 'blanco'; $odd1=1; } ?>">
			      <td style="padding:4px;"><?php echo Common::getFormattedDate($citem->getCreatedAt(), 'd/m/Y H:i') ?></td>
			      <td style="padding:4px;"><?php echo truncate_text($citem->AppUser->getName().' '.$citem->AppUser->getLastName(), 28, '...') ?></td>
			      <td style="padding:4px;"><?php echo truncate_text($citem->RealProperty->getName(), 35, '...') ?></td>
			      <td style="padding:4px;text-align:center;">
			      	<a href="<?php echo 'http://'.$hostname.'/property?id='.$citem->getRealPropertyId() ?>" title="Propiedad en la Web" target="_blank"><img src="/admin/images/icon_company.jpg" border="0"/></a>
			      </td>
			      <td style="padding:4px;text-align:center;">
			      	<a href="<?php echo url_for('home/contactDetails?id='.$citem->getId()) ?>" title="Mas información"><img border="0" src="/admin/images/icon_message.gif" /></a>
			      </td>
			    </tr>
		    <?php endforeach; ?>
			</table>
			<?php else: ?>
				<div class="mensajeSistema comun"><ul><li>No hay contactos registrados</li></ul></div>
			<?php endif; ?>
		</div>
		<div class="paneles" style="width:47%;height:400px;float:left;overflow:auto;">
			<h1>Búsquedas desde la Web</h1>
			<?php if ($qSearchs > 0): ?>
				<table width="100%" cellspacing="0" border="0" class="listados">
			    <tr>
			      <th width="20%" align="left">Fecha</th>
			      <th width="30%" align="left">Usuario</th>
			      <th width="37%" align="left">Criterios</th>
			      <th width="13%" style="text-align:center;" colspan="2">Opciones</th>
			    </tr>
			    <?php
		      	foreach ($searchs as $item):
		      		$_infoFromDB = SearchProfile::getStringInfoFromDBObject($item->SearchProfile);
		      ?>
			    <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
			      <td style="padding:4px;"><?php echo Common::getFormattedDate($item->SearchProfile->getCreatedAt(), 'd/m/Y H:i') ?></td>
			      <td style="padding:4px;"><?php echo truncate_text($item->SearchProfile->AppUser->getName().' '.$item->SearchProfile->AppUser->getLastName(), 28, '...') ?></td>
			      <td style="padding:4px;"><?php echo truncate_text($_infoFromDB['criterios'], 35, '...') ?></td>
			      <td style="padding:4px;text-align:center;">
			      	<a href="<?php echo 'http://'.$hostname.'/search'.$_infoFromDB['query_string'] ?>" title="Reproducir búsqueda" target="_blank"><img src="/admin/images/icon_company.jpg" border="0"/></a>
			      </td>
			      <td style="padding:4px;text-align:center;">
			      	<a href="<?php echo url_for('home/searchDetails?id='.$item->getSearchProfileId()) ?>" title="Mas información"><img border="0" src="/admin/images/icon_message.gif" /></a>
			      </td>
			    </tr>
			    <?php endforeach; ?>
				</table>
			<?php else: ?>
				<div class="mensajeSistema comun"><ul><li>No hay búsquedas registradas</li></ul></div>
			<?php endif; ?>
		</div>
	</div>
<?php else: ?>
	<div style="width:100%;text-align:center;">
		<br /><br />
		<img src="/admin/images/home.png" width="150" border="0" />
	</div>
<?php endif; ?>
  <div class="clear"></div>
</div>