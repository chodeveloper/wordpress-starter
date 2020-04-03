<?php
/**
* Template Name: Community page template
*/

get_header();
?>
	<div class="wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

            <?php
            // sort by date and contributor (the most recent article at the top)
			$args = array( 'post_type' =>  'post', 'order' => 'ASC' ); 
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
                            if ( in_category(get_cat_ID("Community") ) ) :
                                ?>
                                <section class="section community">
                                    <?php
                                        the_title('<h4 class="community-title">', '</h4>');
                                        the_content();
                                    ?>
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