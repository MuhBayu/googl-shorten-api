<?php
/**
* Library Name: GOOGLE SHORTEN API
* by: MBN_12
* http://bayuu.net
* http://github.com/MuhBayu
*/

class Google_Shorten
{
	protected static $_APIKEY;
	protected static $_URI_SERVER;
	protected static $_SSL_VERIFY;
	protected static $_projection;
	public function __construct()
	{
		$this->_projection = 'FULL'; // DEFAULT-nya FULL
		$this->_SSL_VERIFY = FALSE; // DEFAULT-nya FALSE
	}
	public function setApiKey($val) {
		$this->_APIKEY = $val;
	}
	public function setProjection($val='FULL') {
		$this->_projection = $val;
	}
	public function setSSL($val=TRUE) {
		$this->_SSL_VERIFY = $val;
	}
	public function getProjection() {
		$projection = [
				'FULL' => 'returns the creation timestamp and all available analytics',
				'ANALYTICS_CLICKS' => 'returns only click counts',
				'ANALYTICS_TOP_STRINGS' => 'returns only top string counts (e.g. referrers, countries, etc'
			];
		return $projection;
	}
	public function shortURL($_URL) {
		$postData = ['longUrl' => $_URL];
		$jsonData = json_encode($postData);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.$this->_APIKEY);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->_SSL_VERIFY);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
		$response 	= curl_exec($ch);
		$status_code 	= curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$json 		= json_decode($response);
		curl_close($ch);
		if($status_code == 200) {
			return json_encode($json, JSON_PRETTY_PRINT);	
		}
	}
	public function expandURL($_URL) {
		$params = array(
			'key' => $this->_APIKEY,
			'shortUrl' => $_URL,
			'projection' => $this->_projection);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?' . http_build_query($params));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->_SSL_VERIFY);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
		curl_setopt($ch, CURLOPT_HTTPGET, 1);
		$response 	= curl_exec($ch);
		$status_code 	= curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$json 		= json_decode($response);
		curl_close($ch);
		return json_encode($json, JSON_PRETTY_PRINT);	
		
	}
}

?>
