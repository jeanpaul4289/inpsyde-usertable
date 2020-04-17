<?php
/**
 * The view for the user table.
 *
 * @package InpsydePlugin/public/templates
 */

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<main id="site-content" role="main">
			<div class="content">
				<table id="users_table" class="display table table-striped table-bordered">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Username</th>
							<th>Email</th>
						</tr>
					</thead>
				</table>
				<div id="dialog" title="User Details">
				<p></p>
				</div>
			</div>
		</main>
	</body>
</html>
