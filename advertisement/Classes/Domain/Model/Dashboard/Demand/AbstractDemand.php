<?php

declare(strict_types=1);

namespace Slavlee\Advertisement\Domain\Model\Dashboard\Demand;

use Slavlee\Advertisement\Utility\GeneralUtility;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * AbstractDemand
 */
abstract class AbstractDemand
{
	/**
	 * $enabledFieldsToBeIgnore, array of enabled fields that shall be ignored
	 * @var array
	 */
	protected $enabledFieldsToBeIgnored = [];
	
	/**
	 * $query
	 * @var object
	 */
	protected $query = null;
	
	/**
	 * Create query constraints for $query->matching()
	 * @return array
	 */
	abstract public function createConstraints();
	
	/**
	 * Create query settings for $query->setQuerySettings()
	 * @return array
	 */
	abstract public function createQuerySettings();
	
	/**
	 * Returns the $enabledFieldsToBeIgnored
	 * @return array
	 */
	public function getEnabledFieldsToBeIgnored(): array
	{
		return $this->enabledFieldsToBeIgnored;
	}
	
	/**
	 * Sets the $enabledFieldsToBeIgnored
	 * @param array $enabledFieldsToBeIgnored
	 * @return void
	 */
	public function setEnabledFieldsToBeIgnored(array $enabledFieldsToBeIgnored): void
	{
		$this->enabledFieldsToBeIgnored = $enabledFieldsToBeIgnored;
	}
	
	/**
	 * Returns the query
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\Query
	 */
	public function getQuery(): \TYPO3\CMS\Extbase\Persistence\Generic\Query
	{		
		return $this->query;
	}
	
	/**
	 * Sets the query
	 * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
	 * @return void
	 */
	public function setQuery(\TYPO3\CMS\Extbase\Persistence\Generic\Query $query): void
	{
		$this->query = $query;
	}
	
	/**
	 * Returns the paginateHelper, if we have a pagination going on
	 * @return \Slavlee\Advertisement\Helper\PaginateHelper
	 */
	public function getPaginateHelper()
	{
		return $this->paginateHelper;
	}
}