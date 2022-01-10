<?php

declare(strict_types=1);

namespace Slavlee\Advertisement\Domain\Repository;


use Slavlee\Advertisement\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

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
	 * @return \Doctrine\DBAL\ForwardCompatibility\Result
	 */
	public function findByCampaignAndBanner(\Slavlee\Advertisement\Domain\Model\Campaign $campaign, \Slavlee\Advertisement\Domain\Model\Banner $banner): \Doctrine\DBAL\ForwardCompatibility\Result
	{
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_advertisement_domain_model_campaignstatistic')->createQueryBuilder();
		$queryBuilder
		->select('*')
		->from('tx_advertisement_domain_model_campaignstatistic')
		->where(
			$queryBuilder->expr()->eq('campaign', $queryBuilder->createNamedParameter($campaign->getUid(), \PDO::PARAM_INT)),
			$queryBuilder->expr()->eq('banner', $queryBuilder->createNamedParameter($banner->getUid(), \PDO::PARAM_INT))
 		);
					 
		return $queryBuilder->execute();
	}
}
