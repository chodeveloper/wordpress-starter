<?php
/**
* Template Name: Careers page template
*/
get_header();
?>
	<div class="wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

            <?php
            // sort by date and contributor (the most recent article at the top)
			$args = array( 'post_type' =>  'post', 'orderby' => 'date', 'order' => 'DESC' ); 
			$query = new WP_Query($args);
			
			if ( have_posts() ) : 
				while ( have_posts() ) : the_post(); 
					the_title( '<h1>', '</h1>' ); 
					//the_content();
				endwhile; 
                rewind_posts();
            ?>
                
                <?php
                    
                    if ( $query->have_posts() ) :	
                        while ( $query->have_posts() ) : $query->the_post(); 
                            if ( in_category(get_cat_ID("Careers") ) ) :
                                ?>
                                <section class="section careers">
                                    <?php
                                        the_title('<h4 class="careers-title"><a href="'.get_permalink().'">', '</a></h4>');
                                    ?>
                                    <div class="careers-info">
                                        Posted on <?php the_time('F jS, Y'); ?>
                                    </div>
                                </section>
                                <?php
                            endif;
                        endwhile; 
                    endif;
                else: 
                    _e( 'Sorry, no pages matched your criteria.', 'textdomain' ); 
                endif; 
                ?>
                
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php
get_footer();
