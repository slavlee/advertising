<?php

declare(strict_types=1);

namespace Slavlee\Advertising\Helper;

use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use Slavlee\Advertising\Utility\DebugUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * PaginateHelper
 */
class PaginateHelper
{
	/**
	 * $start
	 * @var int
	 */
	protected $start = 1;
	
	/**
	 * $end
	 * @var int
	 */
	protected $end = 10;
	
	/**
	 * $entriesPerStep
	 * @var int
	 */
	protected $entriesPerStep = 10;
	
	/**
	 * $currentStep
	 * @var int
	 */
	protected $currentStep = 1;
	
	/**
	 * $step
	 * @var int
	 */
	protected $step = 1;
	
	/**
	 * $enable, indicates if we need a pagination
	 * @var bool
	 */
	protected $enable = false;
	
	/**
	 * Create a PaginateHelper
	 * @param array $pagination
	 * @return void
	 */
	public function __construct(array $pagination)
	{
		//@TODO ugly prop assignemnt, becauseit ignores data types
		foreach($pagination as $prop => $value)
		{
			if (isset($this->$prop))
			{
				$this->$prop = $value;
			}
		}
	}
	
	/**
	 * Init a new query
	 * @param Query $query
	 * @return void
	 */
	public function initQuery(Query $query): void
	{
		$query->unsetLimit();
		$query->setOffset(0);		
		$this->end = $query->count() / $this->entriesPerStep;	
		
		if ($this->end > $this->step)
		{
			$this->enable = true;
		}
	}
	
	/**
  *
  * @param Query $query
  * @param int $currentStep
  */
 public function paginate(Query $query, $currentStep): Query
	{
		$this->initQuery($query);
		
		if ($this->enable)
		{
			$this->setCurrentStep($currentStep);
			$newOffset = $this->calculateMySQLOffset();
			$newLimit = $this->entriesPerStep;
			$query->setLimit((int)$newLimit);
			$query->setOffset((int)$newOffset);
		}
		
		return $query;
	}
	
	/**
	 * Returns the currentStep
	 * @return int
	 */
	public function getCurrentStep(): int
	{
		return $this->currentStep;
	}
	
	/**
	 * Set the current step
	 * @param int $currentStep
	 * @return void
	 */
	public function setCurrentStep($currentStep): void
	{
		if($currentStep < $this->start)
		{
			$this->currentStep = $this->start;
		}elseif($currentStep > $this->end)
		{
			$this->currentStep = $this->end;
		}else 
		{
			$this->currentStep = $currentStep;
		}
	}
	
	/**
	 * Returns the start
	 * @return int
	 */
	public function getStart(): int
	{
		return $this->start;
	}
	
	/**
	 * Returns the end
	 * @return int
	 */
	public function getEnd(): int
	{
		return $this->end;
	}
	
	/**
	 * Returns the entriesPerStep
	 * @return int
	 */
	public function getEntriesPerStep(): int
	{
		return (int)$this->entriesPerStep;
	}
	
	/**
	 * Returns the entriesPerStep
	 * @param int $entriesPerStep
	 * @return void
	 */
	public function setEntriesPerStep($entriesPerStep): void
	{
		$this->entriesPerStep = $entriesPerStep;
	}
	
	/**
	 * Return the current pagination bar
	 * @return array
	 */
	public function getPaginationBar(): array
	{
		if (!$this->enable)
		{
			return [];
		}
		
		if ($this->start == 1)
		{
			$previous = ['step' => 1, 'disabled' => true, 'current' => false, 'label' => LocalizationUtility::translate('pagination.previous', 'advertising')];
		}else
		{
			$previous = ['step' => $this->currentStep-1, 'disabled' => $this->currentStep <= $this->start, 'current' => false, 'label' => LocalizationUtility::translate('pagination.previous', 'advertising')];
		}
		
		$bar = [$previous];
		
		for($i = $this->start; $i <= $this->end; $i+= $this->step)
		{
			$bar[] = ['step' => $i, 'disabled' => false, 'current' => $i == $this->currentStep, 'label' => $i];
		}
		
		if ($this->start == $this->end)
		{
			$next = ['step' => $this->end, 'disabled' => true, 'current' => false, 'label' => LocalizationUtility::translate('pagination.next', 'advertising')];
		}else
		{
			$next = ['step' => $this->currentStep+1, 'disabled' => $this->currentStep >= $this->end, 'current' => false, 'label' => LocalizationUtility::translate('pagination.next', 'advertising')];
		}
		
		$bar[] = $next;
		
		return $bar;
	}
	
	/**
	 * Returns the enable
	 * @return bool
	 */
	public function getEnable(): bool
	{
		return $this->enable;
	}
	
	/**
	 * Calculate mySQL Offset from current query and currentStep
	 * @return int
	 */
	public function calculateMySQLOffset(): int
	{
		if ($this->currentStep <= $this->start)
		{
			return 0;
		}
		
		return ($this->currentStep-1) * $this->entriesPerStep;
	}
}