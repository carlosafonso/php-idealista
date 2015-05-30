<?php

namespace Idealista;

class Idealista
{
	private $apiKey;

	private $http;

	public function __construct($apiKey, HttpRequestInterface $http = null)
	{
		$this->apiKey = $apiKey;

		if ($http === null) {
			$this->http = new CurlHttpRequest;
		} else {
			$this->http = $http;
		}
	}

	/**
	 * Performs a search of properties on sale.
	 *
	 * @param	float	$lat
	 * @param	float	$lng
	 * @param	float	$distance
	 * @param	int		$maxItems
	 * @return	object
	 */
	public function searchSale($lat, $lng, $distance, $maxItems)
	{
		$result = $this->http->get("http://idealista-prod.apigee.net/public/2/search?apikey={$this->apiKey}&operation=V&center={$lat},{$lng}&distance={$distance}&maxItems={$maxItems}");
		$obj = json_decode($result);
		return $obj->elementList;
	}

	/**
	 * Returns the HTTP request object being
	 * used by this instance.
	 *
	 * @return	HttpRequestInterface
	 */
	public function getHttpRequest()
	{
		return $this->http;
	}
}