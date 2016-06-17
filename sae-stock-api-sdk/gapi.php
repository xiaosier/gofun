<?php
namespace sinacloud\sae;
class Gapi
{
	private $accessKey;
	private $secretKey;
	private $gapi = 'http://g.sae.sina.com.cn';

	public function __construct($accessKey, $secretKey)
	{
		$this->accessKey = $accessKey;
		$this->secretKey = $secretKey;
	}

	public function get($uri)
	{
		if (!$uri) {
			return false;
		}
		return $this->_curl($uri);
	}

	private function _cal_sign_and_set_header($ch, $uri)
	{
		$method = 'GET';
		$a = array();
		$a[] = $method;
		$a[] = $uri;
		// $timeline unix timestamp
		$timeline = time();
		$b = array('x-sae-accesskey' => $this->accessKey, 'x-sae-timestamp' => $timeline);
		ksort($b);
		foreach ($b as $key => $value) {
			$a[] = sprintf("%s:%s", $key, $value);
		}
		$str = implode("\n", $a);
        $s = hash_hmac('sha256', $str, $this->secretKey, true);
		$b64_s = base64_encode($s);
        $headers = array();
		$headers[] = sprintf('x-sae-accesskey:%s', $this->accessKey);
		$headers[] = sprintf('x-sae-timestamp:%s', $timeline);
        $headers[] = sprintf('Authorization: SAEV1_HMAC_SHA256 %s', $b64_s);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		return $headers;
	}

	private function _curl($uri)
	{
		$ch = curl_init();
		$url = sprintf('%s%s', $this->gapi, $uri);
        curl_setopt($ch, CURLOPT_URL, $url);
		$headers = $this->_cal_sign_and_set_header($ch, $uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$txt = curl_exec($ch);
		$error = curl_errno($ch);
		curl_close($ch);
		if ($error) {
			return false;
		}
		return $txt;
	}
}