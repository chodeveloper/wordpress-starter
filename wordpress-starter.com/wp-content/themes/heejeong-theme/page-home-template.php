<?php
/**
* Template Name: Home page template
*/

get_header();
?>
    <div class="wrap two-columns">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
            <div class="home-content">
            <?php
                while ( have_posts() ) : the_post(); 
                    the_content();
                endwhile; 
            ?>
            </div>
            <?php
                $pages = get_pages( array(
                    'sort_order' => 'ASC',
                    'sort_column' => 'ID'
                ));

                foreach( $pages as $page ) {  
                    if ($page->post_title != "Home") :
                        $content = $page->post_content;
                        //$content = apply_filters( 'the_content', $content );
                        ?>
                        
                        <section class="section-cat">
                            <?php

                            $page_link = sprintf( 
                                '<a href="%1$s" alt="%2$s">%3$s</a>',
                                // esc_url( get_page_link( $page->term_id ) ),
                                esc_url( get_page_link( $page->ID ) ),
                                esc_attr( sprintf( __( 'Go to %s page', 'textdomain' ), $page->post_title ) ),
                                esc_html( "Go to page >>>" )
                            );

                                if ($page->post_title == "Contact") {
                                    ?>
                                    <div class="section-description d-flex align-items-center justify-content-center">
                                        <?php
                                    echo '<a class="btn btn-info text-light" href="'.get_page_link( $page->ID ).'">Get In Touch</a>';
                                }
                                else {
                                    ?>
                                    <div class="section-description">
                                        <?php
                                    echo '<h3 class=cat-title>' . $page->post_title . '</h3>';
                                    echo '<div class=cat-description>' . wp_trim_words( $page->post_content, 30, '...' ) . '</div>';
                                    echo '<p class=cat-link>' . $page_link . '</p>';
                                }
                                
                                ?>
                            </div>
                            <div class="section-image">
                                <?php
                                echo get_the_post_thumbnail( $page->ID, 'medium');
                                ?>
                            </div>  
                        </section>
                        <?php
                    
                endif;
                    
                } 
            ?>

            </main><!-- #main -->
        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div><!-- .wrap -->
<?php
get_footer();
