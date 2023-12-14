<?php

declare(strict_types=1);

namespace Slavlee\Advertising\Domain\Repository;

use Slavlee\Advertising\Domain\Model\Zone;
use Doctrine\DBAL\Result;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use Slavlee\Advertising\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * The repository for Banners
 */
class BannerRepository extends BaseRepository
{
	/**
	 * Find alle Banners assigend to given zones
	 * @param array $zones
	 * @return QueryResult
	 */
	public function findByZones(array $zones): QueryResult
	{
		$query = $this->createQuery();
		
		$query->matching(
			$query->in('zones', $zones)
		);
		
		return $query->execute();
	}
	
	/**
	 * Find all Banners that are assigned to at least one active campaign and given zone
	 * @param \Slavlee\Advertising\Domain\Model\Zone $zone
	 * @return \Doctrine\DBAL\Result
	 */
	public function findFromActiveCampaignsForZone(Zone $zone): Result
	{
		$now = new \DateTime();
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
		$queryBuilder
			->select('tt_content.*')
			->from('tt_content')
			->join(
				'tt_content',
				'tx_advertising_zone_banner_mm',
				'zoneBannerMM',
				$queryBuilder->expr()->eq('zoneBannerMM.uid_foreign', $queryBuilder->quoteIdentifier('tt_content.uid'))
			)
			->join(
				'tt_content',
				'tx_advertising_campaign_banner_mm',
				'campaignBannerMM',
				$queryBuilder->expr()->eq('campaignBannerMM.uid_foreign', $queryBuilder->quoteIdentifier('tt_content.uid'))
			)
			->join(
				'campaignBannerMM',
				'tx_advertising_domain_model_campaign',
				'campaign',
				$queryBuilder->expr()->eq('campaign.uid', $queryBuilder->quoteIdentifier('campaignBannerMM.uid_local'))
			)
			->where(
				$queryBuilder->expr()->eq('CType', $queryBuilder->createNamedParameter('advertising_banner')),
				$queryBuilder->expr()->eq('zoneBannerMM.uid_local', $queryBuilder->createNamedParameter($zone->getUid(), \PDO::PARAM_INT))
			)->andWhere(
				$queryBuilder->expr()->eq('campaign.starttime', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)) . ' OR ' .
				$queryBuilder->expr()->gte('campaign.starttime', $queryBuilder->createNamedParameter($now->getTimestamp(), \PDO::PARAM_INT))
			)->andWhere(
				$queryBuilder->expr()->eq('campaign.endtime', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)) . ' OR ' .
				$queryBuilder->expr()->lte('campaign.endtime', $queryBuilder->createNamedParameter($now->getTimestamp(), \PDO::PARAM_INT))
			);
		
// 		DebugUtility::debugQueryBuilder($queryBuilder);
				
		return $queryBuilder->execute();
	}
}
