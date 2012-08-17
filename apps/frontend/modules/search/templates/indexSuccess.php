<div class="left">
	<div class="resultado">
		<div class="fondo-titulo">
			<div class="titulo"></div>
		</div>
		<?php if (count($oList) > 0): ?>
			<?php if ($sf_user->isAuthenticated()): ?>
				<div class="guardar">
					<a onclick="preserveSearchInDB();">&nbsp;</a>
					<img id="img_rec_loading" src="/images/loader.gif" border="0" style="position:absolute;visibility:hidden;"/>
					<input type="hidden" id="ajax_url_rec_search" value="<?php echo url_for('search/AjaxRecSearchInDB') ?>" />
				</div>
			<?php endif; ?>
			<?php
				$middle_counter = 2;

				foreach ($oList as $p_val):
					$set_css_middle = ''; if ($middle_counter == 3) { $middle_counter = 0; $set_css_middle = ' middle'; } $middle_counter++;

					$_m2_cubiertos = $p_val->getSquareMeters();
					$_m2_terreno   = $p_val->getCoveredArea();
			?>
			<div class="preview<?php echo $set_css_middle ?>">
				<a href="<?php echo url_for('property/index?id='.$p_val->getId()) ?>" id="tt-<?php echo $p_val->getId() ?>" class="white">
					<div class="img">
						<img src="<?php echo Gallery::getFirstGallery($p_val->getId()) ?>" alt="<?php echo $p_val->getName() ?>" />
					</div>
					<p><?php echo truncate_text($p_val->getName(), 50) ?></p>
				</a>
				<div class="tooltip">
					<div class="inside">
						<span class="name"><?php echo truncate_text($p_val->getName(), 50) ?></span>
						<span class="precio"><?php echo Operation::getPrices($p_val->getId(), $sf_user->getCulture()) ?></span>
						<span class="sombra"></span>
						<ul>
							<?php if (!empty($_m2_cubiertos)): ?>
								<li><?php echo $_m2_cubiertos ?> m2 cubiertos.</li>
							<?php endif; ?>
							<?php if (!empty($_m2_terreno)): ?>
								<li><?php echo $_m2_terreno ?> m2 de terreno.</li>
							<?php endif; ?>
							<li><?php echo $p_val->getBedroom()->getName() ?></li>
						</ul>
						<a href="<?php echo url_for('property/index?id='.$p_val->getId()) ?>"></a>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {$("#tt-<?php echo $p_val->getId() ?>").tooltip ({ effect: 'slide', position: "center right", offset: [20, -25]}); });
			</script>
		<?php endforeach; ?>

		<?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params)) ?>

		<?php else: ?>
			<div class="mensajeSistema error"><ul><li>La búsqueda no devolvió ningún resultado</li></ul></div>
		<?php endif; ?>
	</div>
</div>
<?php include_component('home', 'right'); ?>