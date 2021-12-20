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
 * Base repository for all advertisement repositories
 */
class BaseRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
	/**
	 * Disable the storage page behaviour
	 * @return void
	 */
	public function disableStorage()
	{
		$querySettings = $this->createQuery()->getQuerySettings();
		$querySettings->setRespectStoragePage(false);
		$this->setDefaultQuerySettings($querySettings);
	}
}
