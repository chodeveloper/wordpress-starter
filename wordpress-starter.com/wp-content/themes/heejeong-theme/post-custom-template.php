<?php
/**
* Template Name: Post custom template
* Template Post Type: post
*/

get_header();
?>
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
            <?php
            while ( have_posts() ) :
                the_post();

                
                ?>
                <div class="cat-nav">
                    <div class="cat-prev"><?php previous_post_link('%link', '%title', true);?></div>
                    <div class="cat-next"><?php next_post_link('%link', '%title', true);?></div>
                    
                </div>
                <?php
                get_template_part( 'template-parts/content-custom', get_post_type() );
            endwhile; // End of the loop.
            ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div>
<?php
get_footer();
