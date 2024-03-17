<?php

declare(strict_types=1);

namespace Slavlee\Advertising\Domain\Model\Dashboard\Demand;

use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use Slavlee\Advertising\Utility\GeneralUtility;
use Slavlee\Advertising\Helper\PaginateHelper;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Kevin Chileong Lee <support@slavlee.de>, Slavlee
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
  * @return Query
  */
 public function getQuery(): Query
	{		
		return $this->query;
	}
	
	/**
  * Sets the query
  * @param Query $query
  * @return void
  */
 public function setQuery(Query $query): void
	{
		$this->query = $query;
	}
}