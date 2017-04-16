<?php
header('Content-type:application/json');
header('Access-Control-Allow-Origin: *'); 	
require_once('api-lib/Google_shorten_API.php');

/**
*  FUNCTION :
* for SHORT URL -----> shortURL()
* for EXPAND URL ----> expandURL()
*/

$shortUrl = 'http://goo.gl/Wsfmxo';

$googl = new Google_Shorten();
$googl->setApiKey('YOUR API KEY');
$googl->setSSL(true); // SSL_VERIFY
$googl->setProjection('ANALYTICS_CLICKS'); // for ExpandURL

$expandOutput = $googl->expandURL($shortUrl);
$expandParse = json_decode($expandOutput);
if(isset($expandParse->{'kind'})) {
	echo $expandOutput;
} else {
	echo "gagal, ada error..";
}


?>
