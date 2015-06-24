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
 * Class implementing entity for single blocked URL.
 *
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 */
class Url
{
	/**
	 * Numeric identifier of the blocked URL.
	 * @var integer $Id
	 */
	protected $id;
	
	/**
	 * Blocked URL self.
	 * @var string $Url
	 */
	protected $url;

	/**
	 * Date time when was URL updated.
	 * @var string $Updated
	 */
	protected $updated;

	/**
	 * Constructor.
	 * @param integer $id (Optional.)
	 * @param string $url (Optional.)
	 * @param string $updated (Optional.)
	 */
	public function __construct($id = null, $url = null, $updated = null)
	{
		$this->id = $id;
		$this->url = $url;
		$this->updated = $updated;
	}
	
	/**
	 * Exchange values of the object with given array.
	 * @param array $data
	 * @return Url
	 */
	public function exchangeArray($data = array())
	{
		foreach ($data as $key => $val) {
			$lkey = lcfirst($key);
			if (property_exists($this, $lkey)) {
				$this->{$lkey} = $val;
			}
		}
		return $this;
	}

	/**
	 * Retrieve numeric identifier of the blocked URL.
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set numeric identifier of the blocked URL.
	 * @return integer
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
	
	/**
	 * Retrieve blocked URL self.
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}
	
	/**
	 * Set blocked URL self.
	 * @return string
	 */
	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}

	/**
	 * Retrieve date time when was URL updated.
	 * @return string
	 */
	public function getUpdated()
	{
		return $this->updated;
	}

	/**
	 * Set date time when was URL updated.
	 * @param string $updated
	 * @return Url
	 */
	public function setUpdated($updated)
	{
		$this->updated = $updated;
		return $this;
	}

	/**
	 * Retrieve data as array.
	 * @return array
	 */
	public function toArray()
	{
		return array(
			'Id' => $id,
			'Url' => $url,
			'Updated' => $updated,
		);
	}
}