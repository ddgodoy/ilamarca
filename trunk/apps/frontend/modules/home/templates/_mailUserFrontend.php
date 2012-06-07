<html>
	<head>
		<title>Activa tu cuenta</title>
	</head>
	<table>
		<tr>
			<td><strong>Email:</strong>&nbsp;<td>
			<td><?php echo $data['email'] ?></td>
		</tr>
		<tr>
			<td><strong>Para habilitar tu cuenta:</strong>&nbsp;<td>
      <td><a href="<?php echo url_for('user/activateAccount?tk='.$data['token'], true) ?>">click aquí</a></td>
		</tr>
	</table>
</html>