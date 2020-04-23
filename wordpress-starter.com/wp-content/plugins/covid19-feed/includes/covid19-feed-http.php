<?php // COVID-19 Feed Plugin - HTTP API


// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) exit;

$API_BASE = 'https://api.covid19api.com/';

// GET request
function covid_plugin_get_request( $url ) {

    $url = esc_url_raw( $url );

	$args = array(
		'method'      => 'GET'
	);

	return wp_remote_get( $url, $args );
}


// GET responses
function covid_plugin_get_response() {

	$API_URL = 'https://api.covid19api.com/countries';
	$response = covid_plugin_get_request( $API_URL );

	// response data
	$code 		= wp_remote_retrieve_response_code( $response );
	$message	= wp_remote_retrieve_response_message( $response );
	//$body    	= wp_remote_retrieve_body( $response );
	$body 		= json_decode( wp_remote_retrieve_body( $response ), true );
	$headers 	= wp_remote_retrieve_headers( $response );

	$output = array(
		'code' 		=> $code,
		'message'	=> $message,
		'body'		=> $body,
		'headers'	=> $headers
	);
	//var_dump($output);
	
	return $output;
}

function covid_plugin_validate_code( $slug ) {
	$code = 0;
	if ($slug == 'world') $url = 'https://api.covid19api.com/world';
	else $url = 'https://api.covid19api.com/total/country/' . $slug;
	$req = covid_plugin_get_request( $url );
	$code = wp_remote_retrieve_response_code( $req );	
	
	return $code;
}

function covid_plugin_display_response_by_country( $slug ) {

	$name = '';
	$dates = array();
	$confirmed = array();
	$deaths = array();
	$recovered = array();

	if ($slug == 'world') {

		$url = 'https://api.covid19api.com/world';
		$req = covid_plugin_get_request( $url );
		$res = json_decode( wp_remote_retrieve_body( $req ), true );

		foreach ($res as $key => $row) {
			$TotalConfirmed[$key]  = $row['TotalConfirmed'];
		}	
		$TotalConfirmed  = array_column($res, 'TotalConfirmed');	
		array_multisort($TotalConfirmed, SORT_ASC, $res);
	
		for ($i=10; $i>0; $i--) {
			$confirmed[] = $res[sizeof($res) - $i]['TotalConfirmed'];
			$deaths[] = $res[sizeof($res) - $i]['TotalDeaths'];
			$recovered[] = $res[sizeof($res) - $i]['TotalRecovered'];
		}

		$name = "World";
			  
		// Variable that store the date interval 
		// of period 1 day 
		$interval = new DateInterval('P1D'); 
		
		$realEnd = new DateTime(date("jS F Y", strtotime('today - 1 day'))); 
		$realEnd->add($interval); 
		
		$period = new DatePeriod(new DateTime(date("jS F Y", strtotime('today - 10 days'))), $interval, $realEnd); 
		
		foreach($period as $date) {                  
			$dates[] = '"'. $date->format('m/d').'"';  
		} 
		  

	} else {

		$url = 'https://api.covid19api.com/total/country/' . $slug;
		$req = covid_plugin_get_request( $url );
		$res = json_decode( wp_remote_retrieve_body( $req ), true );
		

		for ($i=10; $i>0; $i--) {
			$dates[] = '"'.date("m/d", strtotime($res[sizeof($res) - $i]['Date'])).'"';
			$confirmed[] = $res[sizeof($res) - $i]['Confirmed'];
			$deaths[] = $res[sizeof($res) - $i]['Deaths'];
			$recovered[] = $res[sizeof($res) - $i]['Recovered'];
		}

		$name = $res[0]['Country'];
		
	}

	$dates_str = implode(", ", $dates);	
	$confirmed_str = implode(", ", $confirmed);
	$deaths_str = implode(", ", $deaths);
	$recovered_str = implode(", ", $recovered);

	?>
	<div class="container">
		<canvas id="myChart" width="600" height="400">hello</canvas>
	</div>

	<style>
		#myChart {
			width: 100%;
		}
	</style>

	<script>

	var covidData = {
		labels: [<?php echo $dates_str; ?>],
		datasets: [
			{ 
				data: [<?php echo $deaths_str; ?>],
				label: "Deaths",
				backgroundColor: "rgba(255, 99, 132, 0.2)",
				borderColor: "rgb(255, 99, 132)",
				borderWidth: 1
			},
			{ 
				data: [<?php echo $recovered_str; ?>],
				label: "Recovered",
				backgroundColor: "rgba(54, 162, 235, 0.2)",
				borderColor: "rgb(54, 162, 235)",
				borderWidth: 1
			},
			{ 
				data: [<?php echo $confirmed_str; ?>],
				label: "Confirmed",
				backgroundColor: "rgba(60, 60, 60, 0.4)",
				borderColor: "rgb(60, 60, 60)",
				borderWidth: 1
			}
		]
	};
				
	var chartOptions = {
		legend: {
		display: true,
		position: "bottom",
		labels: {
			boxWidth: 80,
			fontColor: "black"
			}
		}
	};

	var countryChart = new Chart(myChart, {
				type: 'bar',
				data: covidData,
				options: {
					title: {
						display: true,
						text: '<?php echo $name; ?> COVID-19 Cases Data (10 days)'
					},
					tooltips: {
						mode: 'index',
						intersect: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: false,
						}],
						yAxes: [{
							ticks: {
								beginZero: false
							},
							stacked: false
						}]
					}
				}
			});
	
	</script>

	<?php		
	
}


function covid_plugin_shortcode( $atts ) {
	// normalize attribute keys, lowercase
	$atts = array_change_key_case((array)$atts, CASE_LOWER);
	$atts = shortcode_atts(
        array(
            'country' => '',
        ), $atts, 'covid19-feed' );
 
	$country_name = esc_html( $atts['country'] );

	if (covid_plugin_validate_code( $country_name ) != 200) {
		return '<p style="color:red;">Please use the correct slug of country name</p>';
	}
	ob_start();
	covid_plugin_display_response_by_country( $country_name );

	return ob_get_clean();
}

	
 

 






