<div class="content">
  <div class="leftside">
  <div class="mapa">
		<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
		&nbsp;&gt;&nbsp;
		<a href="<?php echo url_for('property/index') ?>"><strong><?php echo __('Properties') ?></strong></a>
		&nbsp;&gt;&nbsp;
		<?php echo __('Propiedades para el Newsletter') ?>
	</div>
  <h1 class="titulos">
  	<?php echo __('Propiedades para el Newsletter') ?>
  	
  	<div style="float:right;width:300px;">
  		<input type="button" value="<?php echo __('Limpiar Newsletter') ?>" class="boton" onclick="document.location='<?php echo url_for('newsletter/clean') ?>';"/>
  		<input type="button" value="<?php echo __('Crear Newsletter') ?>" style="float:right;" class="boton" onclick="window.open('<?php echo url_for('newsletter/builder') ?>');"/>
  	</div>
  </h1>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
    <tr>
      <th width="40%"><?php echo __('Name') ?></th>
      <th width="26%"><?php echo __('Property type') ?></th>
      <th width="30%"><?php echo __('Neighborhood') ?></th>
      <th width="4%"></th>
    </tr>
    <?php foreach ($lista as $item): ?>
    <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
      <td><?php echo $item->getName() ?></td>
      <td><?php echo $item->PropertyType->getName() ?></td>
      <td><?php echo $item->Neighborhood->getName() ?></td>
      <td align="center">
      	<a href="<?php echo url_for('newsletter/delete').'?id='.$item->getId() ?>">
      		<img border="0" src="/admin/images/borrar.png" alt="<?php echo __('Borrar del newsletter') ?>" title="<?php echo __('Borrar del newsletter') ?>">
      	</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table><br />
  <input type="button" value="<?php echo __('Volver al listado') ?>" class="boton" onclick="document.location='<?php echo url_for('property/index') ?>';"/>
  </div>
  <div class="clear"></div>
</div>