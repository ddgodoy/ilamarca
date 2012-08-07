<?php
	$str_module = $sf_params->get('module');
	$index_url  = url_for($str_module.'/index');
	$head_link  = $index_url.'?page='.$iPage.$f_params;
?>
<div class="content">
  <div class="rightside">
    <div class="paneles">
      <form action="<?php echo $index_url ?>" enctype="multipart/form-data" method="post">
        <table cellspacing="4" cellpadding="0" border="0" width="100%">
					<tr><td><?php echo __('By name') ?></td></tr>
					<tr><td><input type="text" name="sch_name" value="<?php echo $sch_name ?>" class="form_input" style="width:98%;"/></td></tr>
          <tr><td style="padding-top:5px;"><input type="submit" name="btn_buscar" value="Buscar" class="boton"></td></tr>
        </table>
      </form>
    </div>
  </div>
  <div class="leftside" style="margin-left:260px;">
  <div class="mapa">
		<a href="<?php echo url_for('email_share/index') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo 'Emails' ?>
	</div>
  <h1 class="titulos">
  	<?php echo __('Listado de Emails') ?><span style="padding-left:10px;font-size:16px;">(box enviar a un amigo)</span>
  </h1>
  	<?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order)) ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
      <tr>
      	<?php if (count($oList) > 0): ?>
	        <th width="10%"><a href="<?php echo $head_link.'&o=created_at&s='.$sort ?>"><?php echo __('Fecha') ?></a></th>
	        <th width="22%"><a href="<?php echo $head_link.'&o=name&s='.$sort ?>"><?php echo __('Name') ?></a></th>
	        <th width="30%"><?php echo __('Email') ?></th>
	        <th width="30%"><?php echo __('Email amigo') ?></th>
	        <th width="4%"></th>
	        <th width="4%"></th>
        <?php else: ?>
        	<th style="text-align:center;"><?php echo __('No results') ?></th>
        <?php endif; ?>
      </tr>
      <?php foreach ($oList as $item): ?>
      <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
        <td><?php echo Common::getFormattedDate($item->getCreatedAt(), 'd/m/Y H:i') ?></td>
        <td><?php echo $item->getName() ?></td>
        <td><?php echo $item->getEmail() ?></td>
        <td><?php echo $item->getEmailFriend() ?></td>
        <td align="center">
        	<a href="<?php echo url_for($str_module.'/show').'?id='.$item->getId() ?>">
        		<img border="0" src="/admin/images/ver.jpg" alt="<?php echo __('Ver') ?>" title="<?php echo __('Detalle') ?>" width="27">
        	</a>
        </td>
        <td align="center">
        	<a href="<?php echo url_for($str_module.'/delete').'?id='.$item->getId() ?>" onclick="return confirm('<?php echo __('Are you sure?') ?>');">
        		<img border="0" src="/admin/images/borrar.png" alt="<?php echo __('Delete') ?>" title="<?php echo __('Delete') ?>">
        	</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order)) ?>
  </div>
  <div class="clear"></div>
</div>