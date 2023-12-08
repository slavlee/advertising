<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Utility;

use Slavlee\Advertising\Cache\Backend\FileBackend;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

class CacheUtility
{
	/**
	 * Return a cache instance
	 * @return \Slavlee\Advertising\Cache\Backend\FileBackend
	 */
	public static function getCacheInstance()
	{
		return GeneralUtility::makeInstance(FileBackend::class);
	}
	
	/**
	 * Format a identifier string for internal usage like Sessions or Caches
	 * @param string $unformattedIdentifier
	 * @return string
	 */
	public static function formatIdentifier($unformattedIdentifier)
	{
		return md5($unformattedIdentifier);
	}
}