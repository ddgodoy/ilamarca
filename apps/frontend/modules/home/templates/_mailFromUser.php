<html>
	<head>
		<title>Consulta desde formulario de contacto</title>
	</head>
	<table>
		<tr>
			<td><strong>Nombre:</strong>&nbsp;<td>
			<td><?php echo $data['nombre'] ?></td>
		</tr>
		<tr>
			<td><strong>Email:</strong>&nbsp;<td>
			<td><?php echo $data['email'] ?></td>
		</tr>
		<tr>
			<td><strong>Teléfono:</strong>&nbsp;<td>
			<td><?php echo $data['telefono'] ?></td>
		</tr>
		<tr>
			<td><strong>Dirección:</strong>&nbsp;<td>
			<td><?php echo $data['direccion'] ?></td>
		</tr>
		<tr>
			<td valign="top"><strong>Consulta:</strong>&nbsp;<td>
			<td><?php echo nl2br($data['consulta']) ?></td>
		</tr>
	</table>
</html>