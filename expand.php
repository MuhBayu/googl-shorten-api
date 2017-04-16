<?php
header('Content-type:application/json');
header('Access-Control-Allow-Origin: *'); 	
require_once('api-lib/Google_shorten_API.php');

/**
*  FUNCTION :
* for SHORT URL -----> shortURL()
* for EXPAND URL ----> expandURL()
*/

$short_Url = 'https://goo.gl/Wsfmxo';

$googl = new Google_Shorten();
$googl->setApiKey('YOUR API KEY');		// Masukan API_KEY kamu disini
$googl->setSSL(true); 				// SSL_VERIFY
$googl->setProjection('ANALYTICS_CLICKS'); 	// for ExpandURL

$response_output = $googl->expandURL($short_Url);
$response_parse = json_decode($response_output);

if(isset($response_parse->{'kind'})) {
	echo $response_output;
} else {
	echo "gagal, ada error..";
}


?>
