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
 * The repository for BannerStatistics
 */
class BannerStatisticRepository extends BaseRepository
{
	/**
	 * Find a banner statistic for given banner and date
	 * @param \Slavlee\Advertisement\Domain\Model\Banner $banner
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
}