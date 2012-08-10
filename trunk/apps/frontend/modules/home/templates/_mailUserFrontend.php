<html>
	<head>
		<title>Activación de cuenta</title>
	</head>
	<table>
		<tr>
			<td>Debes confirmar tu registro completando un último paso, según se indica a continuación.<td>
		</tr>
		<tr><td height="10"></td></tr>
		<tr>
			<td><strong>Para habilitar tu cuenta:</strong>&nbsp;<td>
      <td><a href="<?php echo url_for('user/activateAccount?tk='.$data['token'], true) ?>">click aquí</a></td>
		</tr>
	</table>
</html>