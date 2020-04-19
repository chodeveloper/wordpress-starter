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
                        
                        <?php if ($field['label']=='Budget Range'): ?>
                            <h5><?php echo $field['label']; ?></h5> 
                            <p><?php echo '$' . number_format($field['value'], 2); ?></p> 
                        <?php
                         elseif ($field['label']=='Image'):
                        ?>
                            <img src="<?php echo $field['value']; ?>" style="max-width:300px;height:auto;"/>      
                        <?php
                         else:
                        ?>
                            <h5><?php echo $field['label']; ?></h5> 
                            <p><?php echo $field['value']; ?></p>                        
                    <?php endif; endif; ?>

                <?php endforeach; ?>
            <?php endif; ?>        
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php
get_footer();
