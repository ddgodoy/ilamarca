<html>
	<head>
		<title>Compartir una propiedad</title>
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
			<td><strong>Quiere compartir una propidad:</strong>&nbsp;<td>
            <td><a href="<?php echo $data['url'] ?>">click aqui</a></td>
		</tr>
		<tr>
			<td valign="top"><strong>Comentario:</strong>&nbsp;<td>
			<td><?php echo nl2br($data['comment']) ?></td>
		</tr>
	</table>
</html>