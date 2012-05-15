<div class="left">
	<div class="resultado">
		<div class="fondo-titulo">
			<div class="titulo"></div>
		</div>
            <?php if(count($oList)>0): ?>
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
							<li><?php echo $p_val->getSquareMeters() ?> m2 cubiertos.</li>
							<li><?php echo $p_val->getCoveredArea() ?> m2 de terreno.</li>
							<li><?php echo $p_val->getBedroom()->getName() ?></li>
							<a href="<?php echo url_for('property/index?id='.$p_val->getId()) ?>" title="Más detalles"></a>
						</ul>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {$("#tt-<?php echo $p_val->getId() ?>").tooltip ({ effect: 'slide', position: "center right", offset: [20, -25]}); });
			</script>
		<?php endforeach; ?>
            <?php include_partial('home/pager', array('pager'=>$oPager, 'url'=>$index_url, 'params'=>$f_params.$pager_order)) ?>
          <?php else: ?>
                <div class="mensajeSistema error">
                    <ul>
                        <li>Tu búsqueda no dio ningún resultado </li>
                    </ul>
                </div>
          <?php endif; ?>
	</div>
</div>
<?php include_component('home', 'right'); ?>