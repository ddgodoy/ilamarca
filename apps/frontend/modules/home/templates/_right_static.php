<div class="right">
	<?php include_partial('home/rateProperty') ?>
	<div class="sombra"></div>

	<?php if (!$sf_user->isAuthenticated()): ?>
	<div class="box clearfix">
		<div class="inner clearfix">
			<div class="titulo"><img src="/images/tit_creaperfil.png" alt="Creá tu perfil" /></div>
			<p>Creá tu perfil de preferencias y <strong>las propiedades te encuentran a vos!</strong></p>
			<div class="boton">
				<a href="<?php echo url_for('@loging') ?>" class="ingresar"></a>
			</div>
		</div>
	</div>
	<div class="sombra"></div>
	<?php endif; ?>

	<div class="box clearfix">
		<div class="inner clearfix">
			<div class="titulo"><img src="/images/tit_pertenece.png" alt="Pertenecé a la comunidad" /></div>
			<p>Enviá tu <strong>CV</strong> o tu perfil de <strong>Facebook</strong>.</p>
			<div class="boton">
				<a href="<?php echo url_for('home/contact?perfil=comunidad') ?>" class="enviar"></a>
			</div>
		</div>
	</div>
	<div class="sombra"></div>
</div>