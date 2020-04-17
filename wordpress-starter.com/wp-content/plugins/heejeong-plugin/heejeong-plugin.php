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

        add_settings_field(
            string   $id,
            string   $title,
            callable $callback,
            string   $page,
            string   $section = 'default',
            array    $args = []
        );
        
        */
        
        /*
        // from the first challenge
        add_settings_section( 
            'heejeong_plugin_section_login', 
            null, // 'First Plugin Challenge', 
            array( $this, 'heejeong_plugin_callback_section' ), 
            'heejeong_plugin'
        );
        */  


        //------------------------------------------------------------------------ login page
        add_settings_section( 
            'heejeong_plugin_section_login', 
            'Customize Login Page', 
            array( $this, 'heejeong_plugin_callback_section_login' ), 
            'heejeong_plugin'
        );
        
        // set a custom link for the W logo on the login page 
        // users should be able to set it to anything they like
        add_settings_field(
            'custom_url',
            'Custom URL',
            array( $this, 'heejeong_plugin_callback_field_text' ),
            'heejeong_plugin',
            'heejeong_plugin_section_login',
            [ 'id' => 'custom_url', 'label' => 'Custom URL for the login logo link' ]
        );
    
        /*
        add_settings_field(
            'custom_title',
            'Custom Title',
            array( $this, 'heejeong_plugin_callback_field_text' ),
            'heejeong_plugin',
            'heejeong_plugin_section_login',
            [ 'id' => 'custom_title', 'label' => 'Custom title attribute for the logo link' ]
        );
    
        add_settings_field(
            'custom_style',
            'Custom Style',
            array( $this, 'heejeong_plugin_callback_field_radio' ),
            'heejeong_plugin',
            'heejeong_plugin_section_login',
            [ 'id' => 'custom_style', 'label' => 'Custom CSS for the Login screen' ]
        );
    
        add_settings_field(
            'custom_message',
            'Custom Message',
            array( $this, 'heejeong_plugin_callback_field_textarea' ),
            'heejeong_plugin',
            'heejeong_plugin_section_login',
            [ 'id' => 'custom_message', 'label' => 'Custom text and/or markup' ]
        );
        */
    

        //------------------------------------------------------------------------ admin page
        /*

        add_settings_section( 
            'heejeong_plugin_section_admin', 
            'Customize Admin Area', 
            array( $this, 'heejeong_plugin_callback_section_admin' ), 
            'heejeong_plugin'
        );

        add_settings_field(
            'custom_footer',
            'Custom Footer',
            array( $this, 'heejeong_plugin_callback_field_text' ),
            'heejeong_plugin',
            'heejeong_plugin_section_admin',
            [ 'id' => 'custom_footer', 'label' => 'Custom footer text' ]
        );
    
        add_settings_field(
            'custom_toolbar',
            'Custom Toolbar',
            array( $this, 'heejeong_plugin_callback_field_checkbox' ),
            'heejeong_plugin',
            'heejeong_plugin_section_admin',
            [ 'id' => 'custom_toolbar', 'label' => 'Remove new post and comment links from the Toolbar' ]
        );
    
        add_settings_field(
            'custom_scheme',
            'Custom Scheme',
            array( $this, 'heejeong_plugin_callback_field_select' ),
            'heejeong_plugin',
            'heejeong_plugin_section_admin',
            [ 'id' => 'custom_scheme', 'label' => 'Default color scheme for new users' ]
        );
        
        */
    
        
    }

    // validate plugin settings
    function heejeong_plugin_callback_validate_options($input) {
        
        // todo: add validation functionality..
        
        return $input;
        
    }

    /*
    // callback: first challenge section
    function heejeong_plugin_callback_section() {
        
        echo '<p>My first WP Plugin!</p>';
        
    }
    */

    // callback: login section
    function heejeong_plugin_callback_section_login() {
        
        echo '<p>These settings enable you to customize the WP Login screen.</p>';        
    }

    // callback: admin section
    function heejeong_plugin_callback_section_admin() {
        
        echo '<p>These settings enable you to customize the WP Admin Area.</p>';        
    }
    
    // callback: text field
    function heejeong_plugin_callback_field_text( $args ) {

        // todo: add callback functionality..

        echo 'This will be a text field.';
    }

    // callback: radio field
    function heejeong_plugin_callback_field_radio( $args ) {

        // todo: add callback functionality..

        echo 'This will be a radio field.';
    }

    // callback: textarea field
    function heejeong_plugin_callback_field_textarea( $args ) {

        // todo: add callback functionality..

        echo 'This will be a textarea.';
    }

    // callback: checkbox field
    function heejeong_plugin_callback_field_checkbox( $args ) {

        // todo: add callback functionality..

        echo 'This will be a checkbox.';
    }

    // callback: select field
    function heejeong_plugin_callback_field_select( $args ) {

        // todo: add callback functionality..

        echo 'This will be a select menu.';
    }




    


    // add custom footer text to the admin area
    // users should be able to set it to anything they like

   




}

$heejeongPlugin = new HeejeongPlugin();

