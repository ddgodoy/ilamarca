<div class="content">
	<div class="rightside">
		<div class="paneles" style="text-align:center;">
			<img src="/admin/<?php echo $oValue->getPhoto() ? 'uploads/user/'.$oValue->getPhoto() : 'images/no_user_b.jpg' ?>" border="0"/>
		</div>
	</div>
	<div class="leftside" style="margin-left:260px;">
		<div class="mapa">
			<a href="<?php echo url_for('home/index') ?>"><strong><?php echo __('Home') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<a href="<?php echo url_for('salesman/index') ?>"><strong><?php echo __('Salesmen') ?></strong></a>
			&nbsp;&gt;&nbsp;
			<?php echo __('Detail') ?>
		</div>
		<h1 class="titulos"><?php echo __('Updated record') ?></h1><br />
		<fieldset>
			<table width="100%" cellspacing="4" cellpadding="2" border="0">
				<tr>
					<td width="12%"><label><strong><?php echo __('User role') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->UserRole->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Name') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getName() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Last name') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getLastName() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Email') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getEmail() ?></td>
				</tr>
				<tr>
					<td><label><strong><?php echo __('Enabled') ?>&nbsp;:&nbsp;</strong></label></td>
					<td class="text_detail"><?php echo $oValue->getEnabled() ? __('Yes') : __('No') ?></td>
				</tr>
			</table>
		</fieldset>
		<div style="padding-top:10px;" class="botonera">
			<input type="button" onclick="document.location='<?php echo url_for('salesman/edit').'?id='.$id ?>';" value="<?php echo __('Edit') ?>" class="boton" />
			<input type="button" onclick="document.location='<?php echo url_for('salesman/index') ?>';" value="<?php echo __('Continue to list') ?>" class="boton" />
		</div>
	</div>
	<div class="clear"></div>
</div>