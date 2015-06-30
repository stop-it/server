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
	 * Helper method that inserts test data.
	 * @param \PDO $pdo
	 */
	protected function insertTestData(\PDO $pdo)
	{
		$sql = <<<EOT
INSERT INTO Urls (Url, Updated) VALUES 
('www.test1.cz', '2015-06-25T04:33:30+0200'), 
('www.test2.cz', '2015-06-25T04:33:30+0200'), 
('www.test3.cz', '2015-06-25T04:33:30+0200');
EOT;
		$pdo->exec($sql);
	}

	/**
	 * Helper method that returns count of records in the database.
	 * @param \PDO $pdo
	 * @return integer
	 */
	protected function getCountOfRecords(\PDO $pdo)
	{
		$stmt = $pdo->query('SELECT count(*) FROM Urls ');
		$stmt->execute();

		return (int) $stmt->fetchColumn();
	}

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
		$storage->createSchema();
		$this->assertEquals(1, $storage->getSchemaVersion());
	}

	/**
	 * @covers StopIt\Storage\Sqlite::emptyStorage
	 */
	public function testEmptyStorage()
	{
		$pdo = new \PDO('sqlite::memory:');
		$storage = new Sqlite($pdo);
		$storage->createSchema();
		// 1) insert some URL(s)
		$this->insertTestData($pdo);
		$this->assertEquals(3, $this->getCountOfRecords($pdo));
		// 2) empty storage
		$storage->emptyStorage();
		// 3) test if count of records is 0
		$this->assertEquals(0, $this->getCountOfRecords($pdo));
	}

	/**
	 * @covers StopIt\Storage\Sqlite::checkIfUrlExists
	 */
	public function testCheckIfUrlExists()
	{
		$pdo = new \PDO('sqlite::memory:');
		$storage = new Sqlite($pdo);
		$storage->createSchema();

		$this->insertTestData($pdo);
		$this->assertTrue($storage->checkIfUrlExists('www.test1.cz'));
		$this->assertFalse($storage->checkIfUrlExists('www.test4.cz'));
	}

	/**
	 * @covers StopIt\Storage\Sqlite::insertUrl
	 */
	public function testInsertUrl()
	{
		$pdo = new \PDO('sqlite::memory:');
		$storage = new Sqlite($pdo);
		$storage->createSchema();

		$url1 = $storage->insertUrl('www.test1.cz');
		$this->assertInstanceOf('StopIt\Model\Url', $url1);
		$this->assertEquals(1, $this->getCountOfRecords($pdo));
	}

	/**
	 * @covers StopIt\Storage\Sqlite::removeUrl
	 */
	public function testRemoveUrl()
	{
		$pdo = new \PDO('sqlite::memory:');
		$storage = new Sqlite($pdo);
		$storage->createSchema();

		$this->insertTestData($pdo);
		$url4 = $storage->insertUrl('www.test4.cz');

		$this->assertInstanceOf('StopIt\Model\Url', $url4);
		$this->assertEquals(4, $this->getCountOfRecords($pdo));

		$this->assertTrue($storage->removeUrl('www.test1.cz'));
		$this->assertTrue($storage->removeUrl($url4));

		$this->assertEquals(2, $this->getCountOfRecords($pdo));
		$this->assertFalse($storage->checkIfUrlExists('www.test1.cz'));
		$this->assertFalse($storage->checkIfUrlExists('www.test4.cz'));
	}

	/**
	 * @covers StopIt\Storage\Sqlite::selectUrl
	 */
	public function testSelectUrl()
	{
		$pdo = new \PDO('sqlite::memory:');
		$storage = new Sqlite($pdo);
		$storage->createSchema();

		$this->insertTestData($pdo);

		// 1) test select all data
		$data1 = $storage->selectUrl('1');
		$this->assertEquals(3, count($data1));
		// 2) test select by Url
		$data2 = $storage->selectUrl('Url = "www.test1.cz"');
		$this->assertEquals(1, count($data2));
		$this->assertInstanceOf('StopIt\Model\Url', $data2[0]);
		$this->assertEquals('www.test1.cz', $data2[0]->getUrl());
		// 3) test select by Id
		$data3 = $storage->selectUrl('Id IN (2, 3)');
		$this->assertEquals(2, count($data3));
		// 4) test empty result
		$data4 = $storage->selectUrl('Id = 55');
		$this->assertEquals(0, count($data4));
		// 5) test wrong query
		$this->assertFalse($storage->selectUrl('X'));
	}
}
