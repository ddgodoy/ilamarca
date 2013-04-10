<?php ob_start(); ?>
<html>
 <head>
  <title>iLamarca.com</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <style type="text/css">
    <!--
		.down {
			font-size: 10px;
			font-family: Tahoma, Geneva, sans-serif;
		}
		web {
			text-align: center;
			background-attachment: fixed;
			background-repeat: no-repeat;
			background-position: center;
		}
		.datosbold {
			font-weight: bold;
			text-align: left;
		}
		top {
			background-repeat: no-repeat;
		}
		.rebajada {
			font-family: "Times New Roman", Times, serif;
			font-size: 14px;
			text-align: left;
			color: #666;
			padding-top: 5px;
			padding-left: 8px;
			font-weight: bold;
			font-style: italic;
		}
		-->
	</style>
 </head>
 <body>
	<table width="660" border="0" align="center" cellpadding="0" cellspacing="2" >
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td valign="middle"><img src="http://clasico.ilamarca.com/mails/imgs/arriba.jpg" width="100%"  height="34"></td>
					</tr>
					<tr>
						<td valign="middle"><a href="http://www.ilamarca.com" target="_blank"><img src="http://clasico.ilamarca.com/mails/imgs/logo.jpg" hspace="0" border="0" align="left"></a></td>
					</tr>
					<tr>
						<td height="20" valign="middle"><a href="http://www.ilamarca.com"><img src="http://clasico.ilamarca.com/mails/imgs/vendeoalquila.jpg" border="0" align="right"></a></td>
					</tr>
					<tr>
						<td height="20" valign="middle"><br />
							<table border="0" cellpadding="0">
								<tr>
									<td></td>
									<td><img src="http://clasico.ilamarca.com/mails/imgs/encontranos.jpg" border="0" align="right"></td>
									<td><a href="http://twitter.com/inmolamarca"><img src="http://clasico.ilamarca.com/mails/imgs/tw.jpg" border="0" align="right"></a></td>
									<td><a href="http://www.facebook.com/pages/Inmobiliaria-Lamarca/127227613954322"><img src="http://clasico.ilamarca.com/mails/imgs/fc.jpg" border="0" align="right"></a></td>
								</tr>
								<tr><td colspan="4" align="center"><img src="http://clasico.ilamarca.com/mails/imgs/titulo.jpg" vspace="10" border="0"></td></tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="660">
				<table border="0" cellpadding="0" cellspacing="5" width="660">
					<?php foreach ($lista as $p_key => $p_val): ?>
					<tr>
						<?php foreach ($lista[$p_key] as $propiedad): ?>
							<td width="330">
								<table width="330" border="0" align="center" cellpadding="0" cellspacing="0" >
									<tr>
										<td height="30" colspan="2">
											<p style="padding-top:10px;width:300px;margin:0pt;font-family:Arial;font-size:12px;color:#333;text-align:center;background-image:url(http://www.ilamarca.com/mails/imgs/fdotit.jpg);background-repeat:no-repeat;background-position:center;">
												<b>
													<?php echo truncate_text($propiedad['name'], 80) ?>&nbsp;-&nbsp;<?php echo $propiedad['address'] ?>
												</b>
											</p>
										</td>
									</tr>
									<tr>
										<td height="200" colspan="2" align="center" valign="middle">
											<a href="http://<?php echo $xhost.'/property?id='.$propiedad['id'] ?>">
												<img src="<?php echo 'http://'.$xhost.Gallery::getFirstGallery($propiedad['id']) ?>" alt="<?php echo $propiedad['name'] ?>" vspace="8" border="0" />
											</a>
										</td>
									</tr>
									<tr>
										<td height="50" colspan="2" align="center" valign="middle" style="color:#003366;font-weight:bold;font-size:12px;font-family:Arial;">
											Sup. Cubierta: <?php echo $propiedad['area'] ?> m2 
											- 
											Terreno: <?php echo $propiedad['square'] ?> m2<br />
											Precio: <?php echo Operation::getPrices($propiedad['id'], $sf_user->getCulture()) ?>
										</td>
									</tr>
									<tr>
										<td width="190" valign="top">
											<p style="padding-left:15px;margin-left:0pt;margin-bottom:25px;margin-right:0pt;margin-top: 0pt;font-family:Arial;font-size:12px;color:#3d4448;">
												<span class="datosbold"><?php echo truncate_text($propiedad['detail'], 165) ?></span>
											</p>
										</td>
										<td width="143" align="left" style="padding-top:35px;">
											<a href="http://<?php echo $xhost.'/property?id='.$propiedad['id'] ?>">
												<img src="http://clasico.ilamarca.com/mails/imgs/info.jpg" alt="Info" border="0">
											</a>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="text-align:right;">
											<?php $operation_id = Operation::getPrices($propiedad['id'], $sf_user->getCulture(), true) ?>
											
											<?php if ($operation_id == 1): ?>
												<img src="http://clasico.ilamarca.com/mails/imgs/venta_1.jpg" alt="Propiedad en Venta" border="0">
											<?php else: ?>
												<img src="http://clasico.ilamarca.com/mails/imgs/alquiler_1.jpg" alt="Propiedad en Alquiler" border="0">
											<?php endif; ?>
										</td>
									</tr>
								</table>
							</td>
						<?php endforeach; ?>
						<?php if (count($lista[$p_key]) < 2): ?>
							<td width="330">&nbsp;</td>
						<?php endif; ?>
					</tr>
					<tr><td height="15"></td></tr>
					<?php endforeach; ?>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" valign="middle">
				<a href="http://www.ilamarca.com" class="down"><img src="http://clasico.ilamarca.com/mails/imgs/web.jpg" border="0"></a>
			</td>
		</tr>
		<tr>
			<td align="center" valign="middle">
				<img src="http://clasico.ilamarca.com/mails/imgs/abajo.jpg" width="100%" height="34" border="0">
			</td>
		</tr>
	</table>
	<br />
 </body>
</html>
<?php
	$st_contenido = ob_get_contents();
  ob_end_flush();
?>
<center>
	<textarea style="width:780px;height:400px;border:1px solid #333333;"><?php echo htmlentities(utf8_decode($st_contenido)) ?></textarea>
</center>