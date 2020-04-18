<?php
/**
* Template Name: Project page template
*/

get_header();
?>
	<div class="wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

            <?php 

            $fields = get_field_objects();

            if( $fields ): ?>
                <?php foreach( $fields as $field ): ?>

                    <?php if( $field['value'] ): ?>
                        <h5><?php echo $field['label']; ?></h5> 
                        <p><?php echo $field['value']; ?></p>
                    <?php endif; ?>

                <?php endforeach; ?>
            <?php endif; ?>        
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php
get_footer();
