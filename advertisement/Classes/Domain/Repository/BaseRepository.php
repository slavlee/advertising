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
	 * Force to commit db transaction immediately
	 * @return void
	 */
	public function commit()
	{
		$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class);
		$persistenceManager->persistAll();
	}
	
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
	
	
	/**
	 * Set storage page uid
	 * @param integer $pageUid
	 * @return void
	 */
	public function setStorage($pageUid)
	{
		$querySettings = $this->createQuery()->getQuerySettings();
		$querySettings->setStoragePageIds([$pageUid]);
		$this->setDefaultQuerySettings($querySettings);
	}
}
