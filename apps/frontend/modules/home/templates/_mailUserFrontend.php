<html>
	<head>
		<title>Activación de cuenta</title>
	</head>
	<p>
		Debes confirmar tu registro completando un último paso según se indica a continuación.
	</p>
	<table>
		<tr>
			<td><strong>Para habilitar tu cuenta:</strong>&nbsp;<td>
      <td><a href="<?php echo url_for('user/activateAccount?tk='.$data['token'], true) ?>">click aquí</a></td>
		</tr>
	</table>
</html>