<div class="content">
<?php if (count($searchs) > 0): ?>
	<div class="rightside">
    <div class="paneles">
      <form action="<?php echo url_for('home/index') ?>" enctype="multipart/form-data" method="post">
        <table cellspacing="4" cellpadding="0" border="0" width="100%">
					<tr><td><?php echo __('By name') ?></td></tr>
					<tr><td><input type="text" name="sch_name" value="<?php echo $sch_name ?>" class="form_input" style="width:98%;"/></td></tr>
          <tr><td style="padding-top:5px;"><input type="submit" name="btn_buscar" value="<?php echo __('Search') ?>" class="boton"></td></tr>
        </table>
      </form>
    </div>
  </div>
  <div class="leftside" style="margin-left:260px;">
  <h1 class="titulos">Búsquedas desde la Web</h1>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
      <tr>
        <th width="10%">Fecha</th>
        <th width="15%">Usuario</th>
        <th width="32%">Referencia</th>
        <th width="35%">Criterios</th>
        <th width="4%"></th>
        <th width="4%"></th>
      </tr>
      <?php
      	foreach ($searchs as $item):
      		$_infoFromDB = SearchProfile::getStringInfroFromDBObject($item->SearchProfile);
      ?>
      <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
        <td><?php echo Common::getFormattedDate($item->SearchProfile->getCreatedAt(), 'd/m/Y H:i') ?></td>
        <td><?php echo $item->SearchProfile->AppUser->getName().' '.$item->SearchProfile->AppUser->getLastName() ?></td>
        <td><?php echo $item->SearchProfile->getName() ?></td>
        <td><?php echo $_infoFromDB['criterios'] ?></td>
        <td align="center"></td>
        <td align="center">
        	<a><img border="0" src="/admin/images/icon_message.gif" /></a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
<?php else: ?>
	<div style="width:100%;text-align:center;">
		<br /><br />
		<img src="/admin/images/home.png" width="150" border="0" />
	</div>
<?php endif; ?>
  <div class="clear"></div>
</div>