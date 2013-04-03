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
 <body topmargin="0">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td bgcolor="#FFFFFF">
				<table width="280" border="0" align="center" cellpadding="0" cellspacing="2" >
					<tr>
						<td width="100%">
							<table cellspacing="0" cellpadding="0" width="100%">
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
										<table width="100%" border="0" cellpadding="0">
											<tr>
												<td width="64%"></td>
												<td width="12%"><img src="http://clasico.ilamarca.com/mails/imgs/encontranos.jpg" border="0" align="right"></td>
												<td width="5%"><a href="http://twitter.com/inmolamarca"><img src="http://clasico.ilamarca.com/mails/imgs/tw.jpg" border="0" align="right"></a></td>
												<td width="19%"><a href="http://www.facebook.com/pages/Inmobiliaria-Lamarca/127227613954322"><img src="http://clasico.ilamarca.com/mails/imgs/fc.jpg" border="0" align="right"></a></td>
											</tr>
											<tr><td colspan="4" align="center"><img src="http://clasico.ilamarca.com/mails/imgs/titulo.jpg" vspace="10" border="0"></td></tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="780" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td align="left" valign="top">
									<table width="100%" border="0" cellpadding="0" cellspacing="5">
								<tr>
									<td>
									<?php foreach ($lista as $propiedad): ?>
									<div style="margin-left:60px;margin-bottom:30px;float:left;">
										<table width="280" border="0" align="center" cellpadding="0" cellspacing="0" >
											<tr>
												<td height="30" colspan="2">
													<p style="padding-top:10px;width:300px;margin:0pt;font-family:Arial;font-size:12px;color:#333;text-align:center;background-image:url(http://www.ilamarca.com/mails/imgs/fdotit.jpg);background-repeat:no-repeat;background-position:center;">
														<b>
															<?php echo truncate_text($propiedad->getName(), 80) ?>&nbsp;-&nbsp;<?php echo $propiedad->getAddress() ?>
														</b>
													</p>
												</td>
											</tr>
											<tr>
												<td height="200" colspan="2" align="center" valign="middle">
													<a href="http://<?php echo $xhost.'/property?id='.$propiedad->getId() ?>">
														<img src="<?php echo 'http://'.$xhost.Gallery::getFirstGallery($propiedad->getId()) ?>" alt="<?php echo $propiedad->getName() ?>" vspace="8" border="0" />
													</a>
												</td>
											</tr>
											<tr>
												<td height="50" colspan="2" align="center" valign="middle" style="color:#003366;font-weight:bold;font-size:12px;font-family:Arial;">
													Sup. Cubierta: <?php echo $propiedad->getCoveredArea() ?> m2 
													- 
													Terreno: <?php echo $propiedad->getSquareMeters() ?> m2<br />
													Precio: <?php echo Operation::getPrices($propiedad->getId(), $sf_user->getCulture()) ?>
												</td>
											</tr>
											<tr>
												<td width="190" rowspan="2" valign="top">
													<p style="padding-left:15px;margin-left:0pt;margin-bottom:25px;margin-right:0pt;margin-top: 0pt;font-family:Arial;font-size:12px;color:#3d4448;">
														<span class="datosbold"><?php echo truncate_text($propiedad->getDetail(), 165) ?></span>
													</p>
												</td>
												<td width="143" align="left" valign="top">
													<a href="http://<?php echo $xhost.'/property?id='.$propiedad->getId() ?>">
														<img src="http://clasico.ilamarca.com/mails/imgs/info.jpg" alt="Info" border="0">
													</a>
												</td>
											</tr>
										</table>
									</div>
									<?php endforeach; ?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center" valign="middle"><a href="http://www.ilamarca.com" class="down"><img src="http://clasico.ilamarca.com/mails/imgs/web.jpg" border="0"></a></td>
					</tr>
					<tr>
						<td colspan="2" align="center" valign="middle"><img src="http://clasico.ilamarca.com/mails/imgs/abajo.jpg" width="100%" height="34" border="0"></td>
					</tr>
				</table>
				<br />
			</td>
		</tr>
	</table>
 </body>
</html>
<?php
	$st_contenido = ob_get_contents();
  ob_end_flush();
?>
<textarea style="width:100%;height:400px;border:1px solid #333333;"><?php echo htmlentities($st_contenido) ?></textarea>