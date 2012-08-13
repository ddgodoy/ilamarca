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
					Una nueva propiedad registrada en ilamarca.com coincide con alguna/s de las características que has estado buscando.
				</p>
			<td>
		</tr>
		<tr>
			<td>
				<p>Puedes ver la información detallada haciendo click <a href="<?php echo $data['go_to'] ?>" target="_blank">aquí</a>.</p>
			<td>
		</tr>
		<tr>
			<td><p>Saludos cordiales<br /><?php echo $data['sitio'] ?></p><td>
		</tr>
	</table>
</html>