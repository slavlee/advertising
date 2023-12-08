<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Cache\Backend;

use TYPO3\CMS\Core\Cache\Backend\SimpleFileBackend;
/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */
class FileBackend
{
	/**
	 * @var SimpleFileBackend
	*/
	private $cache;
	
	/**
	 * Create a FileBackend
	* @param SimpleFileBackend $cache
	* @return void
	*/
	public function __construct(SimpleFileBackend $cache)
	{
		$this->cache = $cache;
	}
	
	/**
	 * Get a value from cache
	 * @param string $identifier
	 * @return string|array
	 */
	public function getValueFromCache($identifier)
	{
		return $this->cache->get($identifier);
	}
	
	/**
	 * Set a value to cache
	 * @param string $identifier
	 * @param string|array $value
	 * @param array $tags
	 * @param integer $lifetime, in seconds
	 * @return void
	 */
	public function setValueToCache($identifier, $value, $tags = [], $lifetime = 86400)
	{
		// Set cache tag with name of the extension by default
		if (!in_array('advertising', $tags))
		{
			$tags[] = 'advertising';
		}
		
		$this->cache->set($identifier, $value, $tags, $lifetime);
	}
}