<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Utility;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

class DateUtility
{
	/**
	 * Executes objectManager->get
	 * @param \DateTime $date1
	 * @param \DateTime $date2
	 * @return int
	 */
	public static function diffTotalMinutes(\DateTime $date1, \DateTime $date2)
	{
		return ceil(abs($date1->getTimestamp() - $date2->getTimestamp()) / 60);
	}
}