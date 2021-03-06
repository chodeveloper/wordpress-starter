<?php // My Github Feed Plugin - HTTP API


// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) exit;


// GET request
function my_gitfeed_get_request($url, $username, $password) {

    $url = esc_url_raw( $url );
    
    $args = array(
		'method'      => 'GET',
		'timeout'     => 10,
		'redirection' => 5,
		'user-agent'  => $username
	);

	$args = array(
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( $username . ':' . $password ),
		),
		'method'      => 'GET',
		'timeout'     => 10,
		'redirection' => 5,
		'user-agent'  => $username
	);

	return wp_remote_get( $url, $args );
}


// GET response
function my_gitfeed_get_response($username, $reponame) {

	$user_url = 'https://api.github.com/users/'.$username;
	$user_response = my_gitfeed_get_request( $user_url, $username );

	$repo_url = 'https://api.github.com/repos/'.$username.'/'.$reponame;
	$repo_response = my_gitfeed_get_request( $repo_url, $username );

	$commit_url = $repo_url.'/commits';
	$commit_response = my_gitfeed_get_request( $commit_url, $username );

	// repo_response data
	$user_code  = wp_remote_retrieve_response_code( $user_response );
	$repo_code  = wp_remote_retrieve_response_code( $repo_response );
	$message	= wp_remote_retrieve_response_message( $repo_response );
    $body    	= wp_remote_retrieve_body( $repo_response );
	$headers 	= wp_remote_retrieve_headers( $repo_response );
	$commits 	= wp_remote_retrieve_body( $commit_response );

	$output = array(
		'user_code' => $user_code,
		'repo_code'	=> $repo_code,
		'message'	=> $message,
		'body'		=> $body,
		'header'	=> $header,
		'commit'	=> $commits
	);

	return $output;

}