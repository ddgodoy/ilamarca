<html>
	<head>
		<title>Consulta desde formulario de contacto</title>
	</head>
	<table>
		<tr>
			<td><strong>Email:</strong>&nbsp;<td>
			<td><?php echo $data['email'] ?></td>
		</tr>
		<tr>
			<td><strong>Para Habilitar su cuenta:</strong>&nbsp;<td>
                        <td><a href="<?php echo $data['token'] ?>">click aqui</a></td>
		</tr>
	</table>
</html>