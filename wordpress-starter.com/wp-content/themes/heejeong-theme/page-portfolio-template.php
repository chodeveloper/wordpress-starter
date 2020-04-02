<?php
/**
* Template Name: Portfolio page template
*/
get_header();
?>
	<div class="wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php
			$args = array( 'post_type' =>  'post' ); 
			$query = new WP_Query($args);
			
			if ( have_posts() ) : 
				while ( have_posts() ) : the_post(); 
					the_title( '<h1>', '</h1>' ); 
					//the_content();
				endwhile; 
                rewind_posts();
            ?>
                <section class="section portfolio">
                <?php
                    
                    if ( $query->have_posts() ) :	
                        while ( $query->have_posts() ) : $query->the_post(); 
                            if ( in_category(get_cat_ID("Portfolio") ) ) :
                                ?>
                                <div class="portfolio-gallery">
                                    <a class="portfolio-link" href="<?php echo esc_url( the_permalink() ); ?>">
                                        <div class="portfolio-image"><?php the_post_thumbnail('medium');?></div>
                                        <?php the_title( '<h5 class="portfolio-title">', '</h5>') ?>                                            
                                        <?php the_content(); ?>  
                                    </a>
                                </div>
                                <?php
                            endif;
                        endwhile; 
                    endif;
                else: 
                    _e( 'Sorry, no pages matched your criteria.', 'textdomain' ); 
                endif; 
                ?>
                </section>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php
get_footer();
