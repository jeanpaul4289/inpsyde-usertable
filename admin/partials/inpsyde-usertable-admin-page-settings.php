<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since 1.0.0
 *
 * @package InpsydeUsertable
 * @subpackage InpsydeUsertable/admin/partials
 */

$this->options = get_option( 'ce_name' );
?>
<div class="wrap">
	<h1>Inpsyde User Table Configuration</h1>
	<form method="post" action="options.php">
		<?php
		settings_fields( 'ce_group' );
		do_settings_sections( 'ce_admin' );
		submit_button();
		?>
	</form>
</div>
