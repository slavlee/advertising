<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Slavlee\Advertising\Statistic\GeneralStatistic;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

class BannerUtility
{
	/**
	 * Calculate total and save it in a new \stdClass
	 * @param array $bannerStatistics
	 * @return \stdClass
	 */
	public static function calculateTotalStatistic(array $bannerStatistics) : \stdClass
	{
		$total = new \stdClass();
		$total->delivered = 0;
		$total->clicked = 0;
		$total->beenVisible = 0;		
		
		foreach($bannerStatistics as $bannerStatistic)
		{
			/**
			 * @var \Slavlee\Advertising\Domain\Model\BannerStatistic $bannerStatistic
			 */
			$total->delivered += $bannerStatistic->getDelivered();
			$total->clicked += $bannerStatistic->getClicked();
			$total->beenVisible += $bannerStatistic->getBeenVisible();
		}
		
		$total->ctr = GeneralStatistic::ctr($total->clicked, $total->delivered) . '%';
		
		return $total;
	}		
}