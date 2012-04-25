<div class="left">
	<div class="resultado">
		<div class="fondo-titulo">
			<div class="titulo"></div>
		</div>
		<div class="guardar"><a href=""></a></div>
		<?php
			$middle_counter = 2;

			foreach ($oList as $p_val):
				$set_css_middle = ''; if ($middle_counter == 3) { $middle_counter = 0; $set_css_middle = ' middle'; } $middle_counter++;
		?>
			<div class="preview<?php echo $set_css_middle ?>">
				<a href="#" id="tt-<?php echo $p_val->getId() ?>" class="white">
					<div class="img">
                                            <img src="<?php echo Gallery::getFirstGallery($p_val->getId()) ?>" alt="<?php echo $p_val->getName() ?>" />
                                        </div>
					<p><?php echo $p_val->getName() ?></p>
				</a>
				<div class="tooltip">
					<div class="inside">
						<span class="name"><?php echo $p_val->getName() ?></span>
                                                <span class="precio"><?php echo Operation::getPrices($p_val->getId(), $sf_user->getCulture()) ?></span>
						<span class="sombra"></span>
						<ul>
							<li>750 m2 cubiertos.</li>
							<li>1180 m2 de terreno.</li>
							<li>4 dormitorios en suite y oficina.</li>
							<a href="#" title="Más detalles"></a>
						</ul>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {$("#tt-<?php echo $p_val->getId() ?>").tooltip ({ effect: 'slide', position: "center right", offset: [20, -25]}); });
			</script>
		<?php endforeach; ?>
                <?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order)) ?>
	</div>
</div>
<?php include_component('home', 'right'); ?>