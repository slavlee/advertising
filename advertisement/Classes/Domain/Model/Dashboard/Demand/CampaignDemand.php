<?php

declare(strict_types=1);

namespace Slavlee\Advertisement\Domain\Model\Dashboard\Demand;


use Slavlee\Advertisement\Utility\CampaignUtility;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * CampaignDemand
 */
class CampaignDemand extends AbstractDemand
{
	const STATE_ALL = 'all';
	const STATE_ACTIVE = 'active';
	const STATE_EXPIRED = 'expired';
	const STATE_DISABLED = 'disabled';
	
	/**
	 * $state
	 * @var string
	 */
	protected $state = self::STATE_ALL;
	
	/**
	 * Create query constraints for $query->matching()
	 * @return array
	 */
	public function createConstraints()
	{
		$constraints = [];
		$stateConstraints = [];
		
		switch($this->state)
		{
			case self::STATE_ACTIVE:
				$stateConstraints[] = $this->query->logicalAnd(
					$this->query->equals('hidden', 0),
					$this->query->logicalAnd(
						$this->query->logicalOr(
							$this->query->lessThanOrEqual('starttime', 0),
							$this->query->lessThanOrEqual('starttime', $now)
						),
						$this->query->logicalOr(
							$this->query->lessThanOrEqual('endtime', 0),
							$this->query->greaterThanOrEqual('endtime', $now)
						)
					)
				);
				break;
			case self::STATE_DISABLED:
				$stateConstraints[] = $this->query->equals('hidden', 1);
				break;
			case self::STATE_EXPIRED:
				$now = new \DateTime();
				$stateConstraints[] = $this->query->logicalAnd(
					$this->query->equals('hidden', 0),
					$this->query->greaterThan('endtime', 0),
					$this->query->lessThanOrEqual('endtime', $now)
				);
				break;
		}
		
		$constraints = array_merge($constraints, $stateConstraints);
				
		return $constraints;
	}
	
	/**
	 * Create query settings for $query->setQuerySettings()
	 * @return array
	 */
	public function createQuerySettings()
	{		
		$querySettings = $this->getQuery()->getQuerySettings();
		
		if (count($this->enabledFieldsToBeIgnored) > 0)
		{
			$querySettings->setEnableFieldsToBeIgnored($enableFieldsToIgnore);
			$querySettings->setIgnoreEnableFields(true);
		}
		
		return $querySettings;
	}
	
	/**
	 * Returns the state
	 * @return string
	 */
	public function getState(): string
	{
		return $this->state;
	}
	
	/**
	 * Sets the state
	 * @param string $state
	 * @return void
	 */
	public function setState($state): void
	{
		$this->state = $state;
	}
}