<?php
/**
 * Stop-it server application.
 *
 * @copyright (c) 2015 Leonardo Sedevcic
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */

namespace StopIt\Storage;

use StopIt\Model\Url;

/**
 * Tests from SQLite based storage class.
 *
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 */
class SqliteTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @covers StopIt\Storage\Sqlite::getSchemaVersion
	 */
	public function testGetSchemaVersion()
	{
		$pdo = new \PDO('sqlite::memory:');
		$storage = new Sqlite($pdo);
		$this->assertEquals(0, $storage->getSchemaVersion());
	}

	/**
	 * @covers StopIt\Storage\Sqlite::createSchema
	 */
	public function testCreateSchema()
	{
		$pdo = new \PDO('sqlite::memory:');
		$storage = new Sqlite($pdo);
		$this->assertNull($storage->createSchema());
		$this->assertEquals(1, $storage->getSchemaVersion());
	}

	/**
	 * @covers StopIt\Storage\Sqlite::emptyStorage
	 */
	public function testEmptyStorage()
	{
		$this->markTestIncomplete('Finish `emptyStorage` test!');
	}

	/**
	 * @covers StopIt\Storage\Sqlite::checkIfUrlExists
	 */
	public function testCheckIfUrlExists()
	{
		$this->markTestIncomplete('Finish `checkIfUrlExists` test`');
	}

	/**
	 * @covers StopIt\Storage\Sqlite::insertUrl
	 */
	public function testInsertUrl()
	{
		$this->markTestIncomplete('Finish `insertUrl` test`');
	}
}
