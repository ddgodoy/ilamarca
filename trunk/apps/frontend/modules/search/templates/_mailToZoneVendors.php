<html>
	<head>
		<title><?php echo $data['titulo'] ?></title>
	</head>
	<table>
		<tr>
			<td>Potencial cliente buscando información<td>
		</tr>
		<tr>
			<td>
				<p>
					Un potencial cliente ha completado la solicitud de más información desde la web de ilamarca sobre esta propiedad:
				</p>
				<a href="<?php echo $data['pr_link'] ?>" target="_blank"><?php echo $data['pr_nombre'] ?></a>
				<p>
					Los detalles de la consulta aparecerán en la Home de su Panel de Control como parte del bloque &quot;Contactos desde la Web&quot;.
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