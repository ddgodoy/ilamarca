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
					<div class="img"><img src="/images/trash/ej_01.jpg" alt="imagen de ejemplo" /></div>
					<p><?php echo $p_val->getName() ?></p>
				</a>
				<div class="tooltip">
					<div class="inside">
						<span class="name"><?php echo $p_val->getName() ?></span>
						<span class="precio">US$ 950</span>
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
		<!-- -->
		<div class="paginacion">
			<ul>
				<li><a href="#" class="fondo"><span class="prev"></span></a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">...</a></li>
				<li><a href="#" class="fondo"><span class="next"></span></a></li>
			</ul>
		</div>
		<!-- -->
	</div>
</div>

<div class="right">
	<div class="box clearfix">
		<div class="inner clearfix">
			<div class="titulo"><img src="images/tit_tasa.png" alt="Tasá tu propiedad" /></div>
			<p>
				¿Querés vender o alquilar tu casa?<br />
				Te brindamos la seguridad de un <strong>Perito Tasador Oficial.</strong>
			</p>
			<div class="boton">
				<a href="#" class="vende"></a>
				<a href="#" class="alquila"></a>
			</div>
		</div>
	</div>
	<div class="sombra"></div>
	<div class="box clearfix filtros filtrar">
		<div class="inner clearfix">
			<div class="titulo"><img src="images/tit_filtrosaplicados.png" alt="Filtros Aplicados" /></div>
			<form action="" method="" class="clearfix">
				<div class="rowElem">
					<select name="select2" >
						<option value="opt1">Casa</option>
					</select>
				</div>
				<div class="rowElem">
					<select name="select2" >
						<option value="opt1">Venta</option>
					</select>
				</div>
				<div class="rowElem">
					<select name="select2" >
						<option value="opt1">Córdoba</option>
					</select>
				</div>
				<div class="rowElem">
					<select name="select2" >
						<option value="opt1">Córdoba</option>
					</select>
				</div>
				<div class="rowElem">
					<select name="select2" >
						<option value="opt1">Cerro de las Rosas</option>
					</select>
				</div>
				<div class="rowElem">
					<select name="select2" >
						<option value="opt1">De USD$ 150 a 175</option>
					</select>
				</div>
				<div class="rowElem">
					<select name="select2" >
						<option value="opt1">3 dormitorios</option>
					</select>
				</div>
			</form>
			<a href="<?php echo url_for('@homepage') ?>" class="menos">Eliminar filtros</a>
		</div>
	</div>
	<div class="sombra"></div>
<!--	-->
</div>