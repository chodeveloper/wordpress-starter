<?php
/**
 * Plugin Name:     COVID-19 Feed Plugin
 * Description:     WEBD3027 Project 2: Plugin Development
 * Author:          Heejeong Cho
 * Author URI:      http://www.heejeongcho.com/
 * Text Domain:     covid_plugin
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Covid_Feed
 */

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) exit;

// include plugin dependencies
require_once plugin_dir_path( __FILE__ ) . 'includes/covid19-feed-http.php';

class CovidFeed {

    function __construct() {
        
        add_action( 'admin_menu', array( $this, 'covid_plugin_register_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'covid_plugin_register_settings' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'covid_plugin_scripts_init' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'covid_plugin_scripts_init' ) );
        
        add_action('init', array( $this, 'covid_plugin_shortcodes_init' ));

        register_activation_hook( __FILE__, array( $this, 'covid_plugin_activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'covid_plugin_deactivate' ) );   
    }   
    
    function covid_plugin_scripts_init() {
            
            wp_enqueue_script( 'chart-js', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js');
            wp_enqueue_style( 'chart-js', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css' );
    }

    function covid_plugin_activate() {

        if ( ! current_user_can( 'activate_plugins' ) ) return;
        
        $this->covid_plugin_scripts_init();
        $this->covid_plugin_shortcodes_init();        

        flush_rewrite_rules();       
    }

    function covid_plugin_deactivate() {
        if ( ! current_user_can( 'deactivate_plugins' ) ) return;
        
        delete_option( 'covid_plugin_options' );   
    
        flush_rewrite_rules();
    }

    // default plugin options
    function covid_plugin_options_default() {

        return array(
            'country'           => ''
        );

    }

    // add top-level administrative menu
    function covid_plugin_register_admin_menu() {        
        add_menu_page(
            'COVID-19 Feed Plugin',
            'COVID-19 Feed',
            'manage_options',
            'covid_plugin',
            array( $this, 'covid_plugin_display_settings_page' ),
            'dashicons-chart-area',
            null
        );
    }

    // display the plugin settings page
    function covid_plugin_display_settings_page() {
        
        // check if user is allowed access
        if ( ! current_user_can( 'manage_options' ) ) return;
        
        ?>
        
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <!-- <p>My first WP Plugin!</p> -->
            <form action="options.php" method="post">
                
                <?php
                
                // output security fields
                settings_fields( 'covid_plugin_options' );
                
                // output setting sections
                do_settings_sections( 'covid_plugin' );
                
                // submit button
                submit_button('Get Feed');

                // display result
                echo $this->covid_plugin_display_result();
                
                ?>
                
            </form>
        </div>
        
        <?php
        
    } 

    // register plugin settings
    function covid_plugin_register_settings() {
        
        register_setting( 
            'covid_plugin_options', 
            'covid_plugin_options', 
            'covid_plugin_callback_validate_options' 
        ); 

        //------------------------------------------------------------------------ find section
        add_settings_section( 
            'covid_plugin_section_find', 
            'Go to <a href="https://covid19api.com/" target="_blank" style="text-decoration:none;">COVID-19 API Website</a> ', 
            array( $this, 'covid_plugin_callback_section_find' ), 
            'covid_plugin'
        );
        
        add_settings_field(
            'country',
            'Country Name',
            array( $this, 'covid_plugin_callback_country' ),
            'covid_plugin',
            'covid_plugin_section_find',
            [ 'id' => 'country', 'label' => '' ]
        );  
        
        
    }

    // validate country
    function covid_plugin_callback_validate_options($input) {

        

        if ( ! isset( $input['country'] ) ) {
            
            $input['country'] = null;
            
        }
        
        if ( ! array_key_exists( $input['country'], $select_options ) ) {
            
            $input['country'] = null;
        
        }

        return $input;
        
    }

    // callback: find section
    function covid_plugin_callback_section_find() {

        $options = get_option( 'covid_plugin_options', $this->covid_plugin_options_default() );   
        
        $feed = covid_plugin_get_response();
        
        if ($feed['code'] == 200) {
            if ( $options['country'] != null ) {
                echo '<p>Shortcode to add the feed to your page or post : <b>[covid19-feed country=\''.$options['country'].'\']</b></p>'; 
            } else {
                echo '<p>Please select country name</p>';
            }
        } 
              
    }

    // callback: select field
    function covid_plugin_callback_country( $args ) {
        
        $options = get_option( 'covid_plugin_options', $this->covid_plugin_options_default() );
        
        $id    = isset( $args['id'] )    ? $args['id']    : '';
        $label = isset( $args['label'] ) ? $args['label'] : '';
        
        $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

        $feed = covid_plugin_get_response();

        if ( $feed['code'] == 200 ) {
            $label = '';
        } else {
            $label = 'Unexpected error : '.$feed['user_code'];
        }  
        
        $select_options = array();
        $countries = $feed['body'];
        sort($countries);
        //var_dump($countries);

        foreach($countries as $country) {
            $select_options[$country['Slug']] = $country['Country'];
        }
        $select_options = array_slice($select_options, 0, 0, true) +
                        array("world" => "World (Total)") +
                        array_slice($select_options, 0, count($select_options) - 1, true) ;
        
        echo '<select id="covid_plugin_options_'. $id .'" name="covid_plugin_options['. $id .']">';

        if ($selected_option == null) $first_option = 'selected';
        else $first_option = "";

        echo '<option value=""'.$first_option.'>--Please Select Country Name--</option>';
        
        foreach ( $select_options as $value => $option ) {
            
            $selected = selected( $selected_option === $value, true, false );
            
            echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';
            
        }
        
        echo '</select> <br><label for="covid_plugin_options_'. $id .'">'. $label .'</label>';
        
    }

    // display the result
    function covid_plugin_display_result() {

        $options = get_option( 'covid_plugin_options', $this->covid_plugin_options_default() );

        // check if user is allowed access
        if ( ! current_user_can( 'manage_options' ) || $options['country'] == null ) return;

        covid_plugin_display_response_by_country($options['country']);

    }

    function covid_plugin_shortcodes_init() {
        add_shortcode( 'covid19-feed', 'covid_plugin_shortcode' );
    }
    

}

$covidFeed = new CovidFeed();