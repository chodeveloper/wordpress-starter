<?php
/**
 * Plugin Name:     HTTP API
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     http-api
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         HTTP_API
 */


 // GET request
function http_get_request( $url ) {

    $url = esc_url_raw( $url );
    
    $args = array(
		'method'      => 'GET',
		'timeout'     => 10,
        'redirection' => 5,
        'assets'      => array()
	);

	//$args = array( 'user-agent' => 'Plugin Demo: HTTP API; '. home_url() );

	return wp_remote_get( $url, $args );

}

// GET response
function http_get_response() {

	$url = 'https://api.github.com/repos/chodeveloper/wordpress-starter';

	$response = http_get_request( $url );

	// response data

	$code    = wp_remote_retrieve_response_code( $response );
	$message = wp_remote_retrieve_response_message( $response );
    // $body    = wp_remote_retrieve_body( $response );
    $body = json_decode( wp_remote_retrieve_body( $response ), true );
	$headers = wp_remote_retrieve_headers( $response );

	$header_date  = wp_remote_retrieve_header( $response, 'date' );
	$header_type  = wp_remote_retrieve_header( $response, 'content-type' );
	$header_cache = wp_remote_retrieve_header( $response, 'cache-control' );


	// output data

	$output  = '<h2><code>'. $url .'</code></h2>';

	$output .= '<h3>Status</h3>';
	$output .= '<div>Response Code: '    . $code    .'</div>';
	$output .= '<div>Response Message: ' . $message .'</div>';

	$output .= '<h3>Body</h3>';
	$output .= '<pre>';
    ob_start();    


    echo '<span>HTML URL: '. $body['html_url'] .'</span>';
    echo '<span>Git URL: '. $body['git_url'] .'</span>';
    echo '<span>Name: '. $body['name'] .'</span>';
    echo '<span>Owner: '. $body['owner']['login'] .'</span>';
    echo '<span>Description: '. $body['description'] .'</span>';
    echo '<span>Demo Page: '. $body['homepage'] .'</span>';
    echo '<span>Created At: '. $body['created_at'] .'</span>';
    echo '<span>Language: '. $body['language'] .'</span>';    

    // echo var_export($body, true);
	// var_dump( $body );
	$output .= ob_get_clean();
	$output .= '</pre>';

	$output .= '<h3>Headers</h3>';
	$output .= '<div>Response Date: ' . $header_date  .'</div>';
	$output .= '<div>Content Type: '  . $header_type  .'</div>';
	$output .= '<div>Cache Control: ' . $header_cache .'</div>';
	$output .= '<pre>';
    ob_start();
    echo var_export($headers, true);
	// var_dump( $headers );
	$output .= ob_get_clean();
	$output .= '</pre>';

	return $output;

}

// add response to page or post
function displayResponse() {
    
    $url = 'https://api.github.com/repos/chodeveloper/wordpress-starter';

    $response = http_get_request( $url );
    $body = json_decode( wp_remote_retrieve_body( $response ), true );

    $output .= '<pre>';
    ob_start();    

    ?>
    <style>
		pre {
			width: 95%; overflow: auto; margin: 20px 0; padding: 20px;
			color: #fff; background-color: #424242;
            white-space: pre;
		}
        pre span {
            display: block;
        }
	</style>
    <?php
    $output .= '<span>HTML URL: '. $body['html_url'] .'</span>';
    $output .= '<span>Git URL: '. $body['git_url'] .'</span>';
    $output .= '<span>Name: '. $body['name'] .'</span>';
    $output .= '<span>Owner: '. $body['owner']['login'] .'</span>';
    $output .= '<span>Description: '. $body['description'] .'</span>';
    $output .= '<span>Demo Page: '. $body['homepage'] .'</span>';
    $output .= '<span>Created At: '. $body['created_at'] .'</span>';
    $output .= '<span>Language: '. $body['language'] .'</span>';    

	$output .= ob_get_clean();
    $output .= '</pre>';
    
    return $output;

}
add_shortcode( 'http_api_get', 'displayResponse' );


// add top-level administrative menu
function http_get_add_toplevel_menu() {

	add_menu_page(
		'HTTP API: GET Request',
		'HTTP API: GET',
		'manage_options',
		'http_get',
		'http_get_display_settings_page',
		'dashicons-admin-generic',
		null
	);

}
add_action( 'admin_menu', 'http_get_add_toplevel_menu' );


// display the plugin settings page
function http_get_display_settings_page() {

	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;

	?>

	<style>
		pre {
			width: 95%; overflow: auto; margin: 20px 0; padding: 20px;
			color: #fff; background-color: #424242;
            white-space: pre;
		}
        pre span {
            display: block;
        }
	</style>

	<div class="wrap">

		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

        <h3 style="color:red;">Shortcode to display response contents from GitHub : [http_api_get]</h3>

		<?php echo http_get_response(); ?>

	</div>

<?php
}



