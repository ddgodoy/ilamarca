<?php
	$str_module = $sf_params->get('module');
	$index_url  = url_for($str_module.'/index');
	$head_link  = $index_url.'?page='.$iPage.$f_params;
	$propInCart = count($sf_user->getAttribute('properties_in_cart', array()));
?>
<div class="content">
  <div class="rightside">
    <div class="paneles">
      <form action="<?php echo $index_url ?>" enctype="multipart/form-data" method="post">
        <table cellspacing="4" cellpadding="0" border="0" width="100%">
					<tr><td><?php echo __('By name') ?></td></tr>
					<tr><td><input type="text" name="sch_name" value="<?php echo $sch_name ?>" class="form_input" style="width:98%;"/></td></tr>
          <tr><td style="padding-top:5px;"><input type="submit" name="btn_buscar" value="<?php echo __('Search') ?>" class="boton"></td></tr>
        </table>
      </form>
    </div>
  </div>
  <div class="leftside" style="margin-left:260px;">
  <div class="mapa">
		<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>&nbsp;&gt;&nbsp;<?php echo __('Properties') ?>
	</div>
  <h1 class="titulos">
  	<?php echo __('List of Properties') ?>
  	<div style="float:right;width:410px;">
  		<input type="button" value="<?php echo __('Register property') ?>" class="boton" onclick="document.location='<?php echo url_for($str_module.'/register') ?>';"/>
  		<input type="button" id="btn_cant_news" value="Propiedades para newsletter [<?php echo $propInCart ?>]" class="boton" style="float:right;" onclick="gotoNewsletterList();"/>

  		<input type="hidden" id="hidden_cant_incart" value="<?php echo $propInCart ?>" />
  		<input type="hidden" id="cart_url" value="<?php echo url_for('newsletter/addToCart') ?>" />
  		<input type="hidden" id="cart_list" value="<?php echo url_for('newsletter/cartList') ?>" />
  	</div>
  </h1>
    <?php if ($sf_user->hasFlash('notice')): ?>
    <div class="mensajeSistema ok">
      <?php echo __($sf_user->getFlash('notice')) ?>
    </div>
    <?php endif; ?>
  	<?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listados">
      <tr>
      	<?php if (count($oList) > 0): ?>
	        <th width="40%"><a href="<?php echo $head_link.'&o=p.name&s='.$sort ?>"><?php echo __('Name') ?></a></th>
	        <th width="14%"><?php echo __('Property type') ?></th>
	        <th width="20%"><a href="<?php echo $head_link.'&o=n.name&s='.$sort ?>"><?php echo __('Neighborhood') ?></a></th>
          <th width="10%"><a href="<?php echo $head_link.'&o=aus.id&s='.$sort ?>"><?php echo __('Salesman') ?></a></th>
          <th width="4%"></th>
          <th width="4%"></th>
	        <th width="4%"></th>
	        <th width="4%"></th>
        <?php else: ?>
        	<th style="text-align:center;"><?php echo __('No results') ?></th>
        <?php endif; ?>
      </tr>
      <?php foreach ($oList as $item): ?>
      <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>">
        <td><?php echo truncate_text($item->getName(), 70) ?></td>
        <td><?php echo $item->PropertyType->getName() ?></td>
        <td><?php echo truncate_text($item->Neighborhood->getName(), 35) ?></td>
        <td><?php echo ucwords($item->AppUser->getName().' '.$item->AppUser->getLastName()) ?></td>
        <td align="center">
        	<a href="<?php echo url_for($str_module.'/enable').'?id='.$item->getId().'&enable='.$item->getEnabled() ?>">
            <?php if($item->getEnabled()==1): $imagen_enable = 'aceptada.png'; $title = 'Deshabilitar'; else: $imagen_enable = 'confirma.png'; $title = 'Habilitar'; endif; ?>
        		<img border="0" src="/admin/images/<?php echo $imagen_enable ?>" alt="<?php echo __($title) ?>" title="<?php echo __($title) ?>">
        	</a>
        </td>
        <td align="center">
      		<img border="0" src="/admin/images/crear_newsletter.jpg" alt="<?php echo __('Add to newsletter') ?>" title="<?php echo __('Add to newsletter') ?>" width="30" style="cursor:pointer;" onclick="addToNewsCart(<?php echo $item->getId(); ?>);">
        </td>
        <td align="center">
        	<a href="<?php echo url_for($str_module.'/edit').'?id='.$item->getId() ?>">
        		<img border="0" src="/admin/images/editar.png" alt="<?php echo __('Edit') ?>" title="<?php echo __('Edit') ?>">
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
    <?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order, 'oCant'=>$oCant)) ?>
  </div>
  <div class="clear"></div>
</div>