<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Heejeong_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<script src="https://kit.fontawesome.com/6202e2ac09.js"></script>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'heejeong-theme' ); ?></a>

	

	<header id="masthead" class="site-header">
		<?php
		if ( is_front_page() || is_home()) :
		?>
		<div class="site-branding ishome">
			<?php the_header_image_tag(); ?>
				<?php
			else :
				?>
		<div class="site-branding isnothome">
				<?php
			endif;
				?>
			<div class="site-banner">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			$heejeong_theme_description = get_bloginfo( 'description', 'display' );
			if ( $heejeong_theme_description ) :
				?>
				<p class="site-description"><?php echo $heejeong_theme_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
			<div class=wrap>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
