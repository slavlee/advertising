<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

class ZoneUtility
{
	/**
	 * Return the banner to display on the next request
	 * based on their priorities
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage|array $banners
	 * @return \Slavlee\Advertisement\Domain\Model\Banner
	 */
	public static function getNextBanner($banners)
	{
		// Convert ObjectStorage
		if (is_object($banners) && get_class($banners) == \TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
		{
			$banners = $banners->toArray();
		}
		
		// At the moment treat all banners equally
		$count = count($banners);
		$index = rand(0, $count-1);
		
		return $banners[$index];
	}
}