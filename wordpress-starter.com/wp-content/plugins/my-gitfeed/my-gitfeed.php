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

        if ( ! current_user_can( 'activate_plugins' ) ) return;
    
        flush_rewrite_rules();
    }

    function my_gitfeed_deactivate() {
        if ( ! current_user_can( 'deactivate_plugins' ) ) return;
        
    
        flush_rewrite_rules();
    }

    // default plugin options
    function my_gitfeed_options_default() {

        return array(
            'username'     => '',
            'password'     => '',
            'reponame'     => ''
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
                submit_button('Get Feeds');
                
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
            'Get Github repository feeds of your project', 
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
            'password',
            'Password',
            array( $this, 'my_gitfeed_callback_password' ),
            'my_gitfeed',
            'my_gitfeed_section_find'
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

        // password
        if ( isset( $input['password'] ) ) {
            
            $input['password'] = sanitize_text_field( $input['password'] );
            
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
         
        $response = my_gitfeed_get_response($options['username'], $options['reponame']);

        if ( $options['username'] == null || $options['reponame'] == null ) {
            return;
        } else {
            if ($response['repo_code'] == 200) {
                echo '<p>Shortcode to add the feed to your page or post : <b>[mygitfeed user=\''.$options['username'].'\' repo=\''.$options['reponame'].'\']</b></p>'; 
            } 
        }        
    }
    
    // callback: inputs
    function my_gitfeed_callback_username( $args ) {
        
        $options = get_option( 'my_gitfeed_options', $this->my_gitfeed_options_default() );
        
        $id    = isset( $args['id'] )    ? $args['id']    : '';        
        $value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

        $response = my_gitfeed_get_response($options['username'], $options['reponame']);

        if ( $value == null ) {
            $label = 'Username is required';
        } else {
            if ( $response['user_code'] == 404 ) {
                $label = 'Please enter a valid username. Usercode:'.$response['user_code'];
            } elseif ( $response['user_code'] == 200 ) {
                $label = '';
            } else {
                $label = 'Unexpected error : '.$response['user_code'];
            }
        }        
        
        echo '<input id="my_gitfeed_options_'. $id .'" name="my_gitfeed_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
        echo '<label for="my_gitfeed_options_'. $id .'" style="color:red;">'. $label .'</label>'; 
    }

    function my_gitfeed_callback_reponame( $args ) {
        
        $options = get_option( 'my_gitfeed_options', $this->my_gitfeed_options_default() );
        
        $id    = isset( $args['id'] )    ? $args['id']    : '';       
        $value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

        $response = my_gitfeed_get_response($options['username'], $options['reponame']);

        if ( $value == null ) {
            $label = 'Repository Name is required';
        } else {
            if ( $response['user_code'] == 200 && $response['repo_code'] != 200 ) {
                $label = 'Please enter a valid repository name of your project';
            } else {
                $label = '';
            }
        }     
        
        echo '<input id="my_gitfeed_options_'. $id .'" name="my_gitfeed_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
        echo '<label for="my_gitfeed_options_'. $id .'" style="color:red;">'. $label .'</label>'; 
    }

}

$mygitfeed = new MyGitfeed;