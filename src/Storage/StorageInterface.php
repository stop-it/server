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
	 * @param string|Url $url
	 * @return boolean
	 */
	public function checkIfUrlExists($url);

	/**
	 * Insert new URL into the database.
	 * @param string|Url $url
	 * @return Url|boolean Returns `FALSE` when inserting failed.
	 */
	public function insertUrl($url);

	/**
	 * Remove URL from the database.
	 * @param integer|Url|string $url
	 * @return boolean Returns `FALSE` when removing failed.
	 */
	public function removeUrl($url);

	/**
	 * Select URL(s). Parameter `$where` should be valid WHERE part of SQL query.
	 * @param string $where
	 * @return array|boolean Returns `FALSE` when selecting failed. Otherwise 
	 *                       returns array of instances of {@see Url} object.
	 */
	public function selectUrl($where);
}