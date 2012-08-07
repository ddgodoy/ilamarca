<?php $mnGetModule = $sf_params->get('module') ?>
<ul>
	<?php if ($sf_user->hasCredential('super_admin')): ?>
	<li>
		<a href="<?php echo url_for('email_share/index') ?>" class="first<?php echo $mnGetModule=='email_share' ? ' selected' : '' ?>">
			<?php echo __('Emails') ?>
		</a>
	</li>
	<li>
		<a href="<?php echo url_for('salesman/index') ?>" class="first<?php echo $mnGetModule=='salesman' ? ' selected' : '' ?>">
			<?php echo __('Salesmen') ?>
		</a>
	</li>
	<li>
		<a href="<?php echo url_for('country/index') ?>" class="first<?php echo $mnGetModule=='country' ? ' selected' : '' ?>">
			<?php echo __('Countries') ?>
		</a>
	</li>
	<li>
		<a href="<?php echo url_for('geo_zone/index') ?>" class="first<?php echo $mnGetModule=='geo_zone' ? ' selected' : '' ?>">
			<?php echo __('Geo zones') ?>
		</a>
	</li>
	<li>
		<a href="<?php echo url_for('city/index') ?>" class="first<?php echo $mnGetModule=='city' ? ' selected' : '' ?>">
			<?php echo __('Cities') ?>
		</a>
	</li>
	<li>
		<a href="<?php echo url_for('neighborhood/index') ?>" class="first<?php echo $mnGetModule=='neighborhood' ? ' selected' : '' ?>">
			<?php echo __('Neighborhoods') ?>
		</a>
	</li>
	<?php endif; ?>
	<li>
		<a href="<?php echo url_for('property/index') ?>" class="first<?php echo $mnGetModule=='property' ? ' selected' : '' ?>">
			<?php echo __('Properties') ?>
		</a>
	</li>
</ul>