<?php

declare(strict_types=1);

namespace Slavlee\Advertising\Domain\Repository;


/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * The repository for BannerStatistics
 */
class BannerStatisticRepository extends BaseRepository
{
	/**
	 * Find a banner statistic for given banner and date
	 * @param \Slavlee\Advertising\Domain\Model\Banner $banner
	 * @param \DateTime $date
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findByBannerAndDate($banner, $date)
	{
		$query = $this->createQuery();
		$query->matching(
			$query->equals('banner', $banner),
			$query->equals('crdate', $date)
		);
		
		return $query->execute();
	}
	
	/**
	 * Find a banner statistic for given banner and date
	 * @param \Slavlee\Advertising\Domain\Model\Banner $banner
	 * @param \Slavlee\Advertising\Domain\Model\Campaign $campaign
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findByBannerAndCampaign(\Slavlee\Advertising\Domain\Model\Banner $banner, \Slavlee\Advertising\Domain\Model\Campaign $campaign)
	{
		$query = $this->createQuery();
		$query->matching(
			$query->equals('banner', $banner),
			$query->equals('campaign', $campaign),
			$query->logicalAnd(
				$query->logicalOr(
					$query->equals('starttime', 0),
					$query->greaterThanOrEqual('starttime', $campaign->getStartTime())
				),
				$query->logicalOr(
					$query->equals('endtime', 0),
					$query->lessThanOrEqual('endtime', $campaign->getEndtime())
				)
			)
		);
	
		return $query->execute();
	}
	
	/**
	 * Find a banner statistic for given banner and date
	 * @param \Slavlee\Advertising\Domain\Model\Banner $banner
	 * @param \Slavlee\Advertising\Domain\Model\Campaign $campaign
	 * @param \DateTime $date
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findByBannerCampaignAndDate(\Slavlee\Advertising\Domain\Model\Banner $banner, \Slavlee\Advertising\Domain\Model\Campaign $campaign, \DateTime $date)
	{
		$query = $this->createQuery();
		$query->matching(
			$query->equals('banner', $banner),
			$query->equals('crdate', $date),
		$query->logicalAnd(
			$query->logicalOr(
					$query->equals('starttime', 0),
					$query->greaterThanOrEqual('starttime', $campaign->getStartTime())
				),
			$query->logicalOr(
					$query->equals('endtime', 0),
					$query->lessThanOrEqual('endtime', $campaign->getEndtime())
				)
			)
		);
	
		return $query->execute();
	}
}
