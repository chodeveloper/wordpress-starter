<?php
/**
 * Plugin Name:     My Github Feed
 * Description:     WEBD3027 Project 2: Plugin Development
 * Author:          Heejeong Cho
 * Author URI:      heejeong.com
 * Text Domain:     my_gitfeed
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         My_Gitfeed
 */

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) exit;

// include plugin dependencies
require_once plugin_dir_path( __FILE__ ) . 'includes/my_gitfeed_http.php';

class MyGitfeed {

    function __construct() {
        add_action( 'admin_menu', array( $this, 'my_gitfeed_register_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'my_gitfeed_register_settings' ) );

        // add_action( 'init', array( $this, 'my_gitfeed_add_custom_post_type' ) );
        register_activation_hook( __FILE__, array( $this, 'my_gitfeed_activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'my_gitfeed_deactivate' ) );   
    }     

    function my_gitfeed_activate() {
        // check if user is allowed access
        if ( ! current_user_can( 'activate_plugins' ) ) return;
        // trigger the function that registers the custom post type
        
    
        // clear the permalinks after the post type has been registered
        flush_rewrite_rules();
    }

    function my_gitfeed_deactivate() {
        // check if user is allowed access
        if ( ! current_user_can( 'deactivate_plugins' ) ) return;
        // unregister the post type, so the rules are no longer in memory
        
    
        // clear the permalinks to remove our post type's rules from the database
        flush_rewrite_rules();
    }

    // default plugin options
    function my_gitfeed_options_default() {

        return array(
            'username'     => '',
            'reponame'         => ''
        );

    }

    // add top-level administrative menu
    function my_gitfeed_register_admin_menu() {        
        add_menu_page(
            'My Github Feed Plugin',
            'My Github Feed',
            'manage_options',
            'my_gitfeed',
            array( $this, 'my_gitfeed_display_settings_page' ),
            'dashicons-code-standards',
            null
        );
    }

    // display the plugin settings page
    function my_gitfeed_display_settings_page() {
        
        // check if user is allowed access
        if ( ! current_user_can( 'manage_options' ) ) return;
        
        ?>
        
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <!-- <p>My first WP Plugin!</p> -->
            <form action="options.php" method="post">
                
                <?php
                
                // output security fields
                settings_fields( 'my_gitfeed_options' );
                
                // output setting sections
                do_settings_sections( 'my_gitfeed' );
                
                // submit button
                submit_button();
                
                ?>
                
            </form>
        </div>
        
        <?php
        
    }   

    // register plugin settings
    function my_gitfeed_register_settings() {
        
        register_setting( 
            'my_gitfeed_options', 
            'my_gitfeed_options', 
            'my_gitfeed_callback_validate_options' 
        ); 

        //------------------------------------------------------------------------ find section
        add_settings_section( 
            'my_gitfeed_section_find', 
            'Find your Github repository feeds', 
            array( $this, 'my_gitfeed_callback_section_find' ), 
            'my_gitfeed'
        );
        
        add_settings_field(
            'username',
            'Github Username',
            array( $this, 'my_gitfeed_callback_username' ),
            'my_gitfeed',
            'my_gitfeed_section_find',
            [ 'id' => 'username', 'label' => '' ]
        );  
        
        add_settings_field(
            'reponame',
            'Repository Name',
            array( $this, 'my_gitfeed_callback_reponame' ),
            'my_gitfeed',
            'my_gitfeed_section_find',
            [ 'id' => 'reponame', 'label' => '' ]
        ); 
    }

    // validate username
    function my_gitfeed_callback_validate_options($input) {

        // username
        if ( isset( $input['username'] ) ) {
            
            $input['username'] = sanitize_text_field( $input['username'] );
            
        }

        // repo
        if ( isset( $input['reponame'] ) ) {
            
            $input['reponame'] = sanitize_text_field( $input['reponame'] );
            
        }

        return $input;
        
    }

    // callback: find section
    function my_gitfeed_callback_section_find() {

        $options = get_option( 'my_gitfeed_options', $this->my_gitfeed_options_default() );
        
        echo '<p>Shortcode to add the feed to your page or post : [mygitfeed user=\''.$options['username'].'\' repo=\''.$options['reponame'].'\']</p>';      
    }
    
    // callback: inputs
    function my_gitfeed_callback_username( $args ) {
        
        $options = get_option( 'my_gitfeed_options', $this->my_gitfeed_options_default() );
        
        $id    = isset( $args['id'] )    ? $args['id']    : '';
        
        $value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
        
        echo '<input id="my_gitfeed_options_'. $id .'" name="my_gitfeed_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
        echo '<label for="my_gitfeed_options_'. $id .'">'. $label .'</label>'; 
    }

    function my_gitfeed_callback_reponame( $args ) {
        
        $options = get_option( 'my_gitfeed_options', $this->my_gitfeed_options_default() );
        
        $id    = isset( $args['id'] )    ? $args['id']    : '';
        
        $value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
        
        echo '<input id="my_gitfeed_options_'. $id .'" name="my_gitfeed_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
        echo '<label for="my_gitfeed_options_'. $id .'">'. $label .'</label>'; 
    }

}

$mygitfeed = new MyGitfeed;