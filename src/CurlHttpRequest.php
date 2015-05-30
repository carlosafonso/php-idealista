<?php

namespace Idealista;

class CurlHttpRequest implements HttpRequestInterface
{
	public function get($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$r = curl_exec($ch);
		curl_close($ch);
		return $r;
	}
}