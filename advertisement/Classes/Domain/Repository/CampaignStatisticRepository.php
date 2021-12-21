<?php

declare(strict_types=1);

namespace Slavlee\Advertisement\Domain\Repository;


/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * The repository for CampaignStatistics
 */
class CampaignStatisticRepository extends BaseRepository
{
	/**
	 * Find campaign statistic for campaign and banner
	 * @param \Slavlee\Advertisement\Domain\Model\Campaign $campaign
	 * @param \Slavlee\Advertisement\Domain\Model\Banner $banner
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findByCampaignAndBanner(\Slavlee\Advertisement\Domain\Model\Campaign $campaign, \Slavlee\Advertisement\Domain\Model\Banner $banner): \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	{
		$query = $this->createQuery();
		$query->matching(
			$query->equals('campaign', $campaign),
			$query->equals('banner', $banner)
		);
		
		return $query->execute();
	}
}
