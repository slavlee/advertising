<?php

declare(strict_types=1);

namespace Slavlee\Advertising\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */
/**
 * Base repository for all advertising repositories
 */
class BaseRepository extends Repository
{
	/**
	 * Force to commit db transaction immediately
	 * @return void
	 */
	public function commit()
	{
		$persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
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
