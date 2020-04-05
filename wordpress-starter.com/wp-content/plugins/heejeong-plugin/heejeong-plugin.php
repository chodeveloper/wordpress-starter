<?php
/**
 * Plugin Name:     Heejeong Plugin
 * Description:     This is my first plugin!
 * Author:          Heejeong Cho
 * Text Domain:     heejeong_plugin
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Heejeong_Plugin
 */

// Your code starts here.

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) exit;



class HeejeongPlugin {  
   
    function __construct() {
        add_action( 'admin_menu', array( $this, 'heejeong_plugin_register_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'heejeong_plugin_register_settings' ) );

        add_action( 'init', array( $this, 'heejeong_plugin_add_custom_post_type' ) );
        register_activation_hook( __FILE__, array( $this, 'heejeong_plugin_activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'heejeong_plugin_deactivate' ) );       
    }   

    // add top-level administrative menu
    function heejeong_plugin_register_admin_menu() {
        
        /* 
            add_menu_page(
                string   $page_title, 
                string   $menu_title, 
                string   $capability, 
                string   $menu_slug, 
                callable $function = '', 
                string   $icon_url = '', 
                int      $position = null 
            )
        */
        
        add_menu_page(
            'Heejeong Plugin Settings',
            'Heejeong Plugin',
            'manage_options',
            'heejeong_plugin',
            array( $this, 'heejeong_plugin_display_settings_page' ),
            'dashicons-admin-generic',
            null
        );
        
    }

    // display the plugin settings page
    function heejeong_plugin_display_settings_page() {
        
        // check if user is allowed access
        if ( ! current_user_can( 'manage_options' ) ) return;
        
        ?>
        
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <!-- <p>My first WP Plugin!</p> -->
            <form action="options.php" method="post">
                
                <?php
                
                // output security fields
                settings_fields( 'heejeong_plugin_options' );
                
                // output setting sections
                do_settings_sections( 'heejeong_plugin' );
                
                // submit button
                // submit_button();
                
                ?>
                
            </form>
        </div>
        
        <?php
        
    }   

    // register plugin settings
    function heejeong_plugin_register_settings() {
        
        /*
        
        register_setting( 
            string   $option_group, 
            string   $option_name, 
            callable $sanitize_callback
        );
        
        */
        
        register_setting( 
            'heejeong_plugin_options', 
            'heejeong_plugin_options', 
            'heejeong_plugin_callback_validate_options' 
        ); 

        /*
	
        add_settings_section( 
            string   $id, 
            string   $title, 
            callable $callback, 
            string   $page
        );
        
        */
        
        add_settings_section( 
            'heejeong_plugin_section_login', 
            null, // 'First Plugin Challenge', 
            array( $this, 'heejeong_plugin_callback_section' ), 
            'heejeong_plugin'
        );
        
    }

    // validate plugin settings
    function heejeong_plugin_callback_validate_options($input) {
        
        // todo: add validation functionality..
        
        return $input;
        
    }

    // callback: challenge section
    function heejeong_plugin_callback_section() {
        
        echo '<p>My first WP Plugin!</p>';
        
    }

    // add custom post type
    function heejeong_plugin_add_custom_post_type() {

        /*

            register_post_type(
                string       $post_type,
                array|string $args = array()
            )

            For a list of $args, check out:
            https://developer.wordpress.org/reference/functions/register_post_type/

        */

        $args = array(
            'labels'             => array( 'name' => 'MyPlugin' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'myplugin' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        );

        register_post_type( 'myplugin', $args );
    }

    function heejeong_plugin_activate() {
        // trigger the function that registers the custom post type
        $this->heejeong_plugin_add_custom_post_type();
    
        // clear the permalinks after the post type has been registered
        flush_rewrite_rules();
    }

    function heejeong_plugin_deactivate() {
        // unregister the post type, so the rules are no longer in memory
        unregister_post_type( 'myplugin' );
    
        // clear the permalinks to remove our post type's rules from the database
        flush_rewrite_rules();
    }

}

$heejeongPlugin = new HeejeongPlugin();

