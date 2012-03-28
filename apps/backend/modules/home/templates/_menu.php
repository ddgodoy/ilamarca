<?php $mnGetModule = $sf_params->get('module') ?>
<ul>
	<?php if ($sf_user->hasCredential('super_admin')): ?>
	<li>
		<a href="<?php echo url_for('company/index') ?>" class="first<?php echo $mnGetModule=='company' ? ' selected' : '' ?>">
			<?php echo __('Companies') ?>
		</a>
	</li>
	<?php endif; ?>
	<?php if ($sf_user->hasCredential('company_admin')): ?>
	<li>
		<a href="<?php echo url_for('user/index') ?>" class="first<?php echo $mnGetModule=='user' ? ' selected' : '' ?>">
			<?php echo __('Users') ?>
		</a>
	</li>
	<?php endif; ?>
	<?php if ($sf_user->hasCredential('account_admin')): ?>
	<li>
		<a href="<?php echo url_for('account/index') ?>" class="first<?php echo $mnGetModule=='account' ? ' selected' : '' ?>">
			<?php echo __('Accounts') ?>
		</a>
	</li>
	<?php endif; ?>
</ul>