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
 * Simple interface defining storage.
 *
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 */
interface StorageInterface
{
	/**
	 * Retrieve schema version.
	 * @return integer
	 */
	public function getSchemaVersion();
	
	/**
	 * Create storage schema.
	 */
	public function createSchema();

	/**
	 * Clear all data from the storage.
	 */
	public function emptyStorage();

	/**
	 * Check if URL exists in our database.
	 * @param string $url
	 * @return boolean
	 */
	public function checkIfUrlExists($url);

	/**
	 * Insert new URL into the database.
	 * @param string $url
	 * @return Url|boolean Returns `FALSE` when inserting failed.
	 */
	public function insertUrl($url);
}