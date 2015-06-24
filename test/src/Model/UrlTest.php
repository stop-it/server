<?php
/**
 * Stop-it server application.
 *
 * @copyright (c) 2015 Leonardo Sedevcic
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */

namespace StopIt\Model;

/**
 * Tests for {@see Url} class.
 *
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 */
class UrlTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Url $emptyUrl
	 */
	protected $emptyUrl;

	/**
	 * @var Url $sampleUrl
	 */
	protected $sampleUrl;

	/**
	 * Set-up test objects.
	 */
	public function setUp()
	{
		$this->emptyUrl = new Url();
		$this->sampleUrl = new Url(
			1,
			'http://www.test.url',
			'2015-06-24T23:34:00+0200'
		);
	}

	/**
	 * @covers StopIt\Model\Url::getId
	 */
	public function testGetId()
	{
		$this->assertNull($this->emptyUrl->getId());
		$this->assertEquals(1, $this->sampleUrl->getId());
	}

	/**
	 * @covers StopIt\Model\Url::setId
	 */
	public function testSetId()
	{
		$this->assertEquals(10, $this->emptyUrl->setId(10)->getId());
		$this->assertNull($this->emptyUrl->setId(null)->getId());
	}

	/**
	 * @covers StopIt\Model\Url::getUrl
	 */
	public function testGetUrl()
	{
		$this->assertNull($this->emptyUrl->getUrl());
		$this->assertEquals('http://www.test.url', $this->sampleUrl->getUrl());
	}

	/**
	 * @covers StopIt\Model\Url::setUrl
	 */
	public function testSetUrl()
	{
		$this->assertEquals('http://test.url', $this->emptyUrl->setUrl('http://test.url')->getUrl());
		$this->assertNull($this->emptyUrl->setUrl(null)->getUrl());
	}

	/**
	 * @covers StopIt\Model\Url::getUpdated
	 */
	public function testGetUpdated()
	{
		$this->assertNull($this->emptyUrl->getUpdated());
		$this->assertEquals('2015-06-24T23:34:00+0200', $this->sampleUrl->getUpdated());
	}

	/**
	 * @covers StopIt\Model\Url::exchangeArray
	 */
	public function testExchangeArray()
	{
		$this->markTestIncomplete('Finish "exchangeArray" test!');
	}
	/**
	 * @covers StopIt\Model\Url::toArray
	 */
	public function testToArray()
	{
		$this->markTestIncomplete('Finish "toArray" test!');
	}
}