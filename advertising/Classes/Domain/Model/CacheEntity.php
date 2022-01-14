<?php

declare(strict_types=1);

namespace Slavlee\Advertising\Domain\Model;


use Slavlee\Advertising\Utility\GeneralUtility;
use Slavlee\Advertising\Utility\CacheUtility;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * CacheEntity
 */
class CacheEntity extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * $cache
	 * @var \Slavlee\Advertising\Cache\Backend\FileBackend
	 */
	protected $cache;
	
	/**
	 * Inject $cache
	 * @param \Slavlee\Advertising\Cache\Backend\FileBackend $cache
	 */
	public function injectCache(\Slavlee\Advertising\Cache\Backend\FileBackend $cache)
	{
		$this->cache = $cache;
	}
}
