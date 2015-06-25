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
 * Class implementing SQLite storage.
 *
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 */
class Sqlite implements StorageInterface
{
	/**
	 * @const string Default date time format (RFC3339).
	 */
	const RFC3339 = 'Y-m-d\TH:i:sO';

	/**
	 * Holds instance of {@see \PDO} object.
	 * @var \PDO $pdo
	 */
	protected $pdo;

	/**
	 * Constructor.
	 * @var \PDO $pdo
	 */
	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}
	
	/**
	 * Get schema version.
	 * @return integer
	 */
	public function getSchemaVersion()
	{
		$stmt = $this->pdo->query('PRAGMA user_version;');
		return (int) $stmt->fetchColumn();
	}

	/**
	 * Create storage schema.
	 */
	public function createSchema()
	{
		$sql = <<<EOT
CREATE TABLE Urls (
	Id INTEGER PRIMARY KEY,
	Url TEXT NOT NULL UNIQUE,
	Updated TEXT NOT NULL
);
PRAGMA user_version = 1;
EOT;
		$this->pdo->exec($sql);
	}
	/**
	 * Clear all data from the storage.
	 */
	public function emptyStorage()
	{
		$sql = <<<EOT
DELETE FROM Urls;
VACUUM;
EOT;
		$this->pdo->exec($sql);
	}

	/**
	 * Check if URL exists in our database.
	 * @param string $url
	 * @return boolean
	 */
	public function checkIfUrlExists($url)
	{
		$sql = 'SELECT Id FROM Urls WHERE Url LIKE "%'. $url . '%"';
		$stmt = $this->pdo->query($sql);
		$res = $stmt->fetchAll();

		return (count($res) > 0);
	}

	/**
	 * Insert new URL into the database.
	 * @param string $url
	 * @return Url|boolean Returns `FALSE` when inserting failed.
	 */
	public function insertUrl($url)
	{
		$sql = 'INSERT INTO Urls (Url, Updated) VALUES (?, ?)';
		$stmt = $this->pdo->prepare($sql);

		$updated = date(self::RFC3339);
		$res = $stmt->execute(array($url, $updated));

		if ($res === false) {
			return false;
		}

		$url = new Url(
			$this->pdo->lastInsertId(),
			$url,
			$updated
		);

		return $url;
	}
}
