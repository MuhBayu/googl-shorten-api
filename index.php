<?php
header('Content-type:application/json');
header('Access-Control-Allow-Origin: *'); 	
require_once('api-lib/Google_shorten_API.php');

/**
*  FUNCTION :
* for SHORT URL -----> shortURL()
* for EXPAND URL ----> expandURL()
*/

$longUrl = 'http://dkit.ga';
$shortUrl = 'http://goo.gl/Wsfmxo';

$client = new Google_Shorten();
$client->setApiKey('AIzaSyDRM-2mjS1AGEsGtzB_ACf_6REpUEoeuwE');
$client->setSSL(false);
$client->setProjection('ANALYTICS_CLICKS');

$expandOutput = $client->expandURL($shortUrl);
$expandParse = json_decode($expandOutput);
if(isset($expandParse->{'kind'})) {
	echo $expandOutput;
} else {
	echo "error";
}


?>