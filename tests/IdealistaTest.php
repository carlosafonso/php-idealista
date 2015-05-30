<?php

namespace Idealista\Tests;

use \PHPUnit_Framework_TestCase;

use Idealista\Idealista;

class IdealistaTest extends PHPUnit_Framework_TestCase
{
	public function testSaleSearch()
	{
		$http = $this->getMockBuilder('Idealista\HttpRequestInterface')
			->getMock();
		$http->expects($this->once())
			->method('get')
			->with($this->equalTo('http://idealista-prod.apigee.net/public/2/search?apikey=foo&operation=V&center=10,20&distance=400&maxItems=50'))
			->will($this->returnValue('{"elementList": [{"foo": "bar"}, {"foo": "baz"}]}'));
		$i = new Idealista('foo', $http);

		$results = $i->searchSale(10, 20, 400, 50);

		$this->assertCount(2, $results);
		$this->assertEquals('bar', $results[0]->foo);
	}

	public function testRequestImplementationShouldBeCurlIfNoneIsGiven()
	{
		$i = new Idealista('foo');

		$this->assertInstanceOf('Idealista\CurlHttpRequest', $i->getHttpRequest());
	}
}