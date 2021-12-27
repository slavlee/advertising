<?php

declare(strict_types=1);

namespace Slavlee\Advertisement\Domain\Model;


use Slavlee\Advertisement\Utility\GeneralUtility;
use Slavlee\Advertisement\Utility\CacheUtility;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
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
	 * @var \Slavlee\Advertisement\Cache\Backend\FileBackend
	 */
	protected $cache;
	
	/**
	 * Inject $cache
	 * @param \Slavlee\Advertisement\Cache\Backend\FileBackend $cache
	 */
	public function injectCache(\Slavlee\Advertisement\Cache\Backend\FileBackend $cache)
	{
		$this->cache = $cache;
	}
}
