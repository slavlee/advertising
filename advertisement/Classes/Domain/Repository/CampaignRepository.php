<?php

declare(strict_types=1);

namespace Slavlee\Advertisement\Domain\Repository;


use Slavlee\Advertisement\Utility\DebugUtility;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * The repository for Campaigns
 */
class CampaignRepository extends BaseRepository
{
	/**
	 * findAll with enable fields to be ignored
	 * @param array $enableFieldsToIgnore
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findAllIgnoreEnableFields(array $enableFieldsToIgnore) : \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	{
		$query = $this->createQuery();
		$query->getQuerySettings()->setEnableFieldsToBeIgnored($enableFieldsToIgnore);
		$query->getQuerySettings()->setIgnoreEnableFields(true);
// 		DebugUtility::debugQuery($query);
		return $query->execute();
	}
	
	/**
	 * findAll with enable fields to be ignored
	 * @param integer $uid
	 * @param array $enableFieldsToIgnore
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findByUidIgnoreEnableFields($uid, array $enableFieldsToIgnore) : \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	{
		$query = $this->createQuery();
		$query->getQuerySettings()->setEnableFieldsToBeIgnored($enableFieldsToIgnore);
		$query->getQuerySettings()->setIgnoreEnableFields(true);
		$query->matching(
			$query->equals('uid', $uid)	
		);
		return $query->execute();
	}
	
	/**
	 * Find all campaigns for given banner
	 * @param \Slavlee\Advertisement\Domain\Model\Banner $banner
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findCampaignsForBanner(\Slavlee\Advertisement\Domain\Model\Banner $banner) : \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	{
		$query = $this->createQuery();
		$query->matching(
			$query->contains('banners', $banner)
		);
// 		DebugUtility::debugQuery($query);
		return $query->execute();
	}
	
	/**
	 * Find all campaigns in given demand context
	 * @param \Slavlee\Advertisement\Domain\Model\Dashboard\Demand\CampaignDemand $demand
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findDemanded(\Slavlee\Advertisement\Domain\Model\Dashboard\Demand\CampaignDemand $demand)
	{
		// We create query for demand object
		$query = $this->createQuery();
		$demand->setQuery($query);
		
		// we create constraints and query settings
		$constraints = $demand->createConstraints();
		$query->setQuerySettings($demand->createQuerySettings());
		
		// we create query
		if ($constraints)
		{
			$query->matching(
				$query->logicalAnd(
					$constraints
				)
			);
		}
		
		// ORDER BY
		$query->setOrderings(['starttime' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING, 'name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING]);		
		
		// we execute query
// 		debug($constraints);
// 		DebugUtility::debugQuery($query);
		return $query->execute();
	}
}
