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
                $categories = get_categories( array(
                    'orderby' => 'include',
                    'order' => 'ASC',
                    'include' => '6,9,7,10,8,'
                ) );

                foreach( $categories as $category ) {
                    if ($category->count != 0){
                        ?>
                        
                        <section class="section-cat">
                            <?php
                            $category_link = sprintf( 
                                '<a href="%1$s" alt="%2$s">%3$s</a>',
                                // esc_url( get_category_link( $category->term_id ) ),
                                esc_url( get_site_url().'/'.$category->slug ),
                                esc_attr( sprintf( __( 'Go to %s page', 'textdomain' ), $category->name ) ),
                                esc_html( "Go to page >>>" )
                            );
                            ?>

                            <div class="section-description">
                                <?php
                                // echo '<p>' . sprintf( esc_html__( 'Category: %s', 'textdomain' ), $category_link ) . '</p> ';
                                // echo '<p>' . sprintf( esc_html__( 'Description: %s', 'textdomain' ), $category->description ) . '</p>';
                                // echo '<p>' . sprintf( esc_html__( 'Post Count: %s', 'textdomain' ), $category->count ) . '</p>';
                                echo '<h3 class=cat-title>' . $category->name . '</h3>';
                                echo '<p class=cat-description>' . $category->description . '</p>';
                                echo '<p class=cat-link>' . $category_link . '</p>';
                                ?>
                            </div>
                            <div class="section-image">
                                <?php
                                if ($category->name == "About") echo '<img src="http://wordpress-starter.com/wp-content/uploads/2020/04/IMG_6351.jpeg" />';
                                elseif ($category->name == "Portfolio") echo '<img src="http://wordpress-starter.com/wp-content/uploads/2020/04/kuni-min-scaled.jpg" />';
                                elseif ($category->name == "News") echo '<img src="http://wordpress-starter.com/wp-content/uploads/2020/04/mandoo-scaled.jpg" />';
                                elseif ($category->name == "Community") echo '<img src="http://wordpress-starter.com/wp-content/uploads/2020/04/IMG_6057.jpeg" />';
                                elseif ($category->name == "Careers") echo '<img src="http://wordpress-starter.com/wp-content/uploads/2020/04/IMG_5475.jpeg" />';                                
                                ?>
                            </div>  
                        </section>
                        <?php
                    }
                    
                } 
            ?>

            </main><!-- #main -->
        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div><!-- .wrap -->
<?php
get_footer();
