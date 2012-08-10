<html>
	<head>
		<title><?php echo $data['titulo'] ?></title>
	</head>
	<table>
		<tr>
			<td>Se han encontrado coincidencias!<td>
		</tr>
		<tr>
			<td>
				<p style="text-align:justify;">
					Una búsqueda realizada desde ilamarca.com coincide con alguna/s de sus propiedades relacionadas.<br />
					Puede ver más información al respecto en la Home de su Panel de Control como parte del bloque &quot;Búsquedas desde la Web&quot;.
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