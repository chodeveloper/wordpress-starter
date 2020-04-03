<?php
/**
* Template Name: Contact page template
*/

get_header();
?>
	<div class="wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

            <?php
            // sort by date and contributor (the most recent article at the top)
			if ( have_posts() ) : 
				while ( have_posts() ) : the_post(); 
					the_title( '<h1>', '</h1>' ); 
					the_content();
				endwhile; 
                rewind_posts();
            else: 
                _e( 'Sorry, no pages matched your criteria.', 'textdomain' ); 
            endif; 
            ?>            
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php
get_footer();
