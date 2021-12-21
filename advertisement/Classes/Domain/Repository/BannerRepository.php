<?php

declare(strict_types=1);

namespace Slavlee\Advertisement\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
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
	public function findByZones(array $zones)
	{
		$query = $this->createQuery();
		
		$query->matching(
			$query->in('zones', $zones)
		);
		
		return $query->execute();
	}
}