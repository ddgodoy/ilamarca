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
				<?php
					$cant = count($data['zone_vnds']);
					$pl_s = '';
					$pl_e = '';
					
					if ($cant > 1) {
						$pl_s = 's';
						$pl_e = 'es';
					}
				?>
				<p>Un potencial cliente ha solicitado más información desde la web de ilamarca sobre esta propiedad:</p>
				<a href="<?php echo $data['pr_link'] ?>" target="_blank"><?php echo $data['pr_nombre'] ?></a>
				<p style="text-align:justify;">
					Ya que la zona donde se encuentra ubicada la propiedad corrresponde a otro<?php echo $pl_s ?> vendedor<?php echo $pl_e ?>, por favor, contacte directamente usando la siguiente información:
				</p>
				<table border="1" cellpadding="3" cellspacing="0">
					<tr>
						<td><strong>Vendedor de la zona</strong></td>
						<td><strong>Email</strong></td>
					</tr>
					<?php foreach ($data['zone_vnds'] as $k => $v): ?>
					<tr>
						<td><?php echo $v ?></td>
						<td><?php echo $k ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
			<td>
		</tr>
        <tr>
          <td>
            <p style="text-align:justify;">
              Comentario del usuario: <?php echo $data['commt'] ?>
            </p>
          </td>
        </tr>
		<tr>
			<td><p>Saludos cordiales<br /><?php echo $data['url_sitio'] ?></p><td>
		</tr>
	</table>
</html>