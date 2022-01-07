<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Statistic;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */


class CampaignStatistic
{
	/**
	 * $campaigns, all campaigns
	 * @var array
	 */
	protected $campaigns = [];
	
	/**
	 * $totalBannersCount, will be also set if getActiveBannersCount is called
	 * @var int
	 */
	private $totalBannersCount = 0;
	
	/**
	 * Create a CampaignStatistic
	 * @param array $campaigns
	 * @return void
	 */
	public function __construct(array $campaigns)
	{
		$this->campaigns = $campaigns;
	}
	
	/**
	 * Return the number of campaings
	 * @return int
	 */
	public function getTotalCampaignsCount(): int
	{
		return count($this->campaigns);
	}
	
	/**
	 * Return the number of active campaings
	 * @return int
	 */
	public function getActiveCampaignsCount(): int
	{
		$count = 0;
		
		foreach($this->campaigns as $campaign)
		{
			if ($campaign->isActive())
			{
				$count++;
			}
		}
		
		return $count;
	}
	
	/**
	 * Return the number of active banners of all campaigns
	 * @return int
	 */
	public function getActiveBannersCount(): int
	{
		$this->totalBannersCount = $count = 0;
		
		foreach($this->campaigns as $campaign)
		{
			$banners = $campaign->getBanners();
			
			foreach ($banners as $banner)
			{
				if ($campaign->isActive())
				{
					$count++;
				}
				
				$this->totalBannersCount++;
			}
		}
		
		return $count;
	}
	
	/**
	 * Returns the total amount of banners
	 * @return int
	 */
	public function getTotalBannersCount(): int
	{
		// if total banners count is zero, then recount
		if ($this->totalBannersCount == 0)
		{
			$this->getActiveBannersCount();
		}
		
		return $this->totalBannersCount;
	}
}