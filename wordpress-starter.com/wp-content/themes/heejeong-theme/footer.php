<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Heejeong_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-menu nav">
			<h4>Menu</h4>
			<?php wp_nav_menu( array( 'theme_location' => 'Footer' ) ); ?>
		</div>
		<div class="site-info">
			<div>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'heejeong-theme' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'heejeong-theme' ), 'WordPress' );
				?>
			</a>
			<br>
			<!-- <span class="sep"> | </span> -->
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s', 'heejeong-theme' ), 'heejeong-theme', '<a href="http://underscores.me/">Heejeong Cho</a>' );
				?>
			</div>
			<div class="footer-menu social">
				<?php wp_nav_menu( array( 'menu' => 'Social') ); ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
