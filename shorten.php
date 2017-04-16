<?php
header('Content-type:application/json');
header('Access-Control-Allow-Origin: *'); 	
require_once('api-lib/Google_shorten_API.php');

/**
*  FUNCTION :
* for SHORT URL -----> shortURL()
* for EXPAND URL ----> expandURL()
*/

$long_Url = 'http://bayuu.net';

$googl = new Google_Shorten();
$googl->setApiKey('YOUR_API_KEY');  // Masukan API_KEY kamu disini
$googl->setSSL(true);               // SSL_VERIFY

$response_output = $googl->shortURL($long_Url);
$response_parse = json_decode($response_output);

if(isset($response_parse->{'kind'})) {
	echo $response_output;
} else {
	echo "gagal, ada error...";
}


?>
