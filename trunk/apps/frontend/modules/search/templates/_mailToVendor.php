<html>
	<head>
		<title><?php echo $data['titulo'] ?></title>
	</head>
	<table>
		<tr>
			<td>Estimado <strong><?php echo $data['vendedor'] ?></strong>:<td>
		</tr>
		<tr>
			<td>
				<p style="text-align:justify;">
					El usuario <strong><?php echo $data['cliente'] ?></strong> ha completado una solicitud de más información sobre una propiedad desde la web de ilamarca.<br />
					Los detalles de esta consulta aparecerán en la Home de su Panel de Control como parte del bloque &quot;Contactos desde la Web&quot;.
				</p>
			<td>
		</tr>
		<tr>
			<td>
				<p>Inicie sesión haciendo click <a href="<?php echo $data['backend'] ?>" target="_blank">aquí</a>.</p>
			<td>
		</tr>
		<tr>
			<td><p>Saludos cordiales<br /><?php echo $data['url_sitio'] ?></p><td>
		</tr>
	</table>
</html>