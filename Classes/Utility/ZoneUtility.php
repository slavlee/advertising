<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Utility;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
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
  * @param ObjectStorage|array $banners
  * @return \Slavlee\Advertising\Domain\Model\Banner
  */
 public static function getNextBanner($banners)
	{
		// Convert ObjectStorage
		if (is_object($banners) && get_class($banners) == ObjectStorage::class)
		{
			$banners = $banners->toArray();
		}
		
		// At the moment treat all banners equally
		$count = count($banners);
		$index = rand(0, $count-1);
		
		return $banners[$index];
	}
}