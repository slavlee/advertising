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

class CampaignUtility
{
	/**
	 * Return the label of the given priority db value
	 * @param integer $priorityInt
	 * @return string
	 */
	public static function getPriorityLabel($priorityInt)
	{		
		return LocalizationUtility::translate('tx_advertisement_domain_model_campaignstatistic.priority.' . $priorityInt, 'advertisement');
	}
}