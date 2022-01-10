<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Statistic;

use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */


class GeneralStatistic
{
	/**
	 * Calculate the Click Trough Rate
	 * @param int $nominator
	 * @param int $denominator
	 * @return float
	 */
	public static function ctr($nominator, $denominator)
	{
		if ($denominator == 0)
		{
			return 0.0;
		}
		
		return (round($nominator / $denominator, 4)) * 100;
	}
}