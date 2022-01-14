<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Service\Campaign;

use Slavlee\Advertising\Domain\Model\CampaignStatistic;
use Slavlee\Advertising\Domain\Model\BannerStatistic;
use Slavlee\Advertising\Statistic\GeneralStatistic;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

class StatisticService extends \Slavlee\Advertising\Service\BaseService
{
	/**
	 * $bannerRepository
	 * @var \Slavlee\Advertising\Domain\Repository\BannerRepository
	 */
	protected $bannerRepository;
	
	/**
	 * $campaignRepository
	 * @var \Slavlee\Advertising\Domain\Repository\CampaignRepository
	 */
	protected $campaignRepository;
	
	/**
	 * $campaignStatisticRepository
	 * @var \Slavlee\Advertising\Domain\Repository\CampaignStatisticRepository
	 */
	protected $campaignStatisticRepository;
	
	/**
	 * $bannerStatisticRepository
	 * @var \Slavlee\Advertising\Domain\Repository\BannerStatisticRepository
	 */
	protected $bannerStatisticRepository;
	
	/***********************************************************************************
	 * INJECTIONS - START
	 **********************************************************************************/
	/**
	 * Inject $bannerRepository
	 * @param \Slavlee\Advertising\Domain\Repository\BannerRepository $bannerRepository
	 * @return void
	 */
	public function injectBannerRepository(\Slavlee\Advertising\Domain\Repository\BannerRepository $bannerRepository)
	{
		$this->bannerRepository = $bannerRepository;
		$this->bannerRepository->setStorage($this->extConf['general']['storagePid']);
	}
	
	/**
	 * Inject $campaignRepository
	 * @param \Slavlee\Advertising\Domain\Repository\CampaignRepository $campaignRepository
	 * @return void
	 */
	public function injectCampaignRepository(\Slavlee\Advertising\Domain\Repository\CampaignRepository $campaignRepository)
	{
		$this->campaignRepository = $campaignRepository;
		$this->campaignRepository->setStorage($this->extConf['general']['storagePid']);
	}
	
	/**
	 * Inject $campaignStatisticRepository
	 * @param \Slavlee\Advertising\Domain\Repository\CampaignStatisticRepository $campaignStatisticRepository
	 * @return void
	 */
	public function injectCampaignStatisticRepository(\Slavlee\Advertising\Domain\Repository\CampaignStatisticRepository $campaignStatisticRepository)
	{
		$this->campaignStatisticRepository = $campaignStatisticRepository;
		$this->campaignStatisticRepository->setStorage($this->extConf['general']['storagePid']);
	}
	
	/**
	 * Inject $bannerStatisticRepository
	 * @param \Slavlee\Advertising\Domain\Repository\BannerStatisticRepository $bannerStatisticRepository
	 * @return void
	 */
	public function injectBannerStatisticRepository(\Slavlee\Advertising\Domain\Repository\BannerStatisticRepository $bannerStatisticRepository)
	{
		$this->bannerStatisticRepository = $bannerStatisticRepository;
		$this->bannerStatisticRepository->setStorage($this->extConf['general']['storagePid']);
	}
	/***********************************************************************************
	 * INJECTIONS - END
	 **********************************************************************************/
	
	/**
	 * Save click event on given banner
	 * @param \Slavlee\Advertising\Domain\Model\Banner $banner
	 * @return void
	 */
	protected function clickedForBanner(\Slavlee\Advertising\Domain\Model\Banner $banner)
	{
		// get all active campaigns for given banner
		$campaigns = $this->findCampaignsForBanner($banner);
		
		// Break if we dont have any campaigns
		if (count($campaigns) <= 0)
		{
			return;
		}
		
		foreach($campaigns as $campaign)
		{
			// get or create campaign statistic object
			$campaignStatistic = $this->findOrCreateCampaignStatisticForBanner($campaign, $banner);
				
			if ($campaignStatistic)
			{
				// increase delivered count
				$campaignStatistic->incrementClicked();
		
				// save to db
				if ($campaignStatistic->_isNew())
				{
					$this->campaignStatisticRepository->add($campaignStatistic);
				}else
				{
					$this->campaignStatisticRepository->update($campaignStatistic);
				}
		
				$this->campaignStatisticRepository->commit();
			}
			
			// get or create banner statistic object
			$bannerStatistic = $this->findOrCreateBannerStatistic($banner, $campaign);
			
			if ($bannerStatistic)
			{
				// increase delivered count
				$bannerStatistic->incrementClicked();
			
				// save to db
				if ($bannerStatistic->_isNew())
				{
					$this->bannerStatisticRepository->add($bannerStatistic);
				}else
				{
					$this->bannerStatisticRepository->update($bannerStatistic);
				}
			
				$this->bannerStatisticRepository->commit();
			}
		}
	}
	
	/**
	 * Ad was delivered, save it in the statistic of
	 * all active campaigns that are related to the given ad
	 * @param array $contentElementData
	 * @return void
	 */
	protected function delivered(array $contentElementData)
	{
		// get banner
		$banner = $this->bannerRepository->findByUid($contentElementData['uid']);
		
		// break if ce is not a banner
		if (!$banner)
		{
			return;
		}
		
		$this->deliveredForBanner($banner);
	}
	
	/**
	 * Ad was delivered, save it in the statistic of
	 * all active campaigns that are related to the given ad
	 * @param \Slavlee\Advertising\Domain\Model\Banner $banner
	 * @return void
	 */
	protected function deliveredForBanner(\Slavlee\Advertising\Domain\Model\Banner $banner)
	{
		// get all active campaigns for given banner
		$campaigns = $this->findCampaignsForBanner($banner);
		
		// Break if we dont have any campaigns
		if (count($campaigns) <= 0)
		{
			return;
		}
		
		foreach($campaigns as $campaign)
		{
			// get or create campaign statistic object
			$campaignStatistic = $this->findOrCreateCampaignStatisticForBanner($campaign, $banner);
				
			if ($campaignStatistic)
			{
				// increase delivered count
				$campaignStatistic->incrementDelivered();
		
				// save to db
				if ($campaignStatistic->_isNew())
				{
					$this->campaignStatisticRepository->add($campaignStatistic);
				}else
				{
					$this->campaignStatisticRepository->update($campaignStatistic);
				}
		
				$this->campaignStatisticRepository->commit();
			}
			
			// get or create the banner statistic object
			$bannerStatistic = $this->findOrCreateBannerStatistic($banner, $campaign);
			
			if ($bannerStatistic)
			{
				$bannerStatistic->incrementDelivered();
				
				if ($bannerStatistic->_isNew())
				{
					$this->bannerStatisticRepository->add($bannerStatistic);
				}else
				{
					$this->bannerStatisticRepository->update($bannerStatistic);
				}
				
				$this->bannerStatisticRepository->commit();
			}
		}
	}
	
	/**
	 * Recalculate campaign statistics based on tracker data for banners
	 * @param \Slavlee\Advertising\Domain\Model\Campaign $campaign
	 * @return \stdClass
	 */
	protected function recalculateCampaignStatisticsWithTrackerData(\Slavlee\Advertising\Domain\Model\Campaign $campaign)
	{
		$banners = $campaign->getBanners();
		$statistics = [];
		$totalStatistic = new \stdClass();
		$totalStatistic->delivered = 0;
		$totalStatistic->clicked = 0;
		$totalStatistic->beenVisible = 0;
		$totalStatistic->ctr = 0;
		
		foreach($banners as $banner)
		{
			$statistic = $this->findOrCreateBannerStatistic($banner, $campaign);
			$identifier = $banner->getUid() . '_' . $campaign->getUid();
			
			// Check if banner/campaign comb was there
			if (!array_key_exists($identifier, $statistics))
			{				
				$statistics[$identifier] = new \stdClass();
				$statistics[$identifier]->banner = $banner;
				$statistics[$identifier]->delivered = 0;
				$statistics[$identifier]->clicked = 0;
				$statistics[$identifier]->beenVisible = 0;
			}
			
			// Save all banner statistics to a campaign in one object
			if ($statistics[$identifier])
			{
				$statistics[$identifier]->delivered += $statistic->getDelivered();
				$statistics[$identifier]->clicked += $statistic->getClicked();
				$statistics[$identifier]->beenVisible += $statistic->getBeenVisible();
			}
		}				
		
		// Save to campaign statistics for banner
		foreach($statistics as $statistic)
		{
			$campaignStatistic = $this->findOrCreateCampaignStatisticForBanner($campaign, $statistic->banner);
			
			if ($campaignStatistic)
			{
				$campaignStatistic->setBeenVisible($statistic->beenVisible);
				$campaignStatistic->setDelivered($statistic->delivered);
				$campaignStatistic->setClicked($statistic->clicked);
				
				if ($campaignStatistic->_isNew())
				{
					$this->campaignStatisticRepository->add($campaignStatistic);
				}else 
				{
					$this->campaignStatisticRepository->update($campaignStatistic);
				}				
			}
		}
		
		$this->lastReturnValue = $totalStatistic;
		
		return $totalStatistic;
	}
	
	/**
	 * get all active campaigns for given content element
	 * @param \Slavlee\Advertising\Domain\Model\Banner $banner
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	protected function findCampaignsForBanner(\Slavlee\Advertising\Domain\Model\Banner $banner) : \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	{
		return $this->campaignRepository->findCampaignsForBanner($banner);
	}
	
	/**
	 * get or create banner statistic object
	 * @param \Slavlee\Advertising\Domain\Model\Banner $banner
	 * @param \Slavlee\Advertising\Domain\Model\Campaign $campaign
	 * @return \Slavlee\Advertising\Domain\Model\BannerStatistic
	 */
	protected function findOrCreateBannerStatistic(\Slavlee\Advertising\Domain\Model\Banner $banner, \Slavlee\Advertising\Domain\Model\Campaign $campaign) : \Slavlee\Advertising\Domain\Model\BannerStatistic
	{
		$today = new \DateTime();
		$today->setTime(0,0,0,0);
		$bannerStatistic = $this->bannerStatisticRepository->findByBannerCampaignAndDate($banner, $campaign, $today)->current();
		
		if (!$bannerStatistic)
		{
			$bannerStatistic = BannerStatistic::makeInstance(['pid' => (int)$this->extConf['general']['storagePid'], 'banner' => $banner, 'campaign' => $campaign, 'crdate' => $today], BannerStatistic::class);
		}
		
		//Make sure campaign is set
		if (!$bannerStatistic->getCampaign())
		{
			$bannerStatistic->setCampaign($campaign);
		}
		
		return $bannerStatistic;
	}
	
	/**
	 * get or create campaign statistic object
	 * @param \Slavlee\Advertising\Domain\Model\Campaign $campaign
	 * @param \Slavlee\Advertising\Domain\Model\Banner $banner
	 * @param boolean $suppressCreate
	 * @return \Slavlee\Advertising\Domain\Model\CampaignStatistic|bool
	 */
	protected function findOrCreateCampaignStatisticForBanner(\Slavlee\Advertising\Domain\Model\Campaign $campaign, \Slavlee\Advertising\Domain\Model\Banner $banner, $suppressCreate = FALSE)
	{
		$campaignStatistic = $this->campaignStatisticRepository->findByCampaignAndBanner($campaign, $banner)->fetch();
		
		if (!$campaignStatistic && !$suppressCreate)
		{
			$campaignStatistic = CampaignStatistic::makeInstance(['pid' => (int)$this->extConf['general']['storagePid'], 'banner' => $banner, 'campaign' => $campaign], CampaignStatistic::class);
		}elseif($campaignStatistic)
		{
			$campaignStatistic = $this->campaignStatisticRepository->findByUid($campaignStatistic['uid']);			
		}
	
		return $campaignStatistic;
	}
	
	/**
	 * Loop through all CampaignStatistic for given Campaign and calculate total statistic metrics
	 * @param \Slavlee\Advertising\Domain\Model\Campaign $campaign
	 * @return \stdClass
	 */
	protected function findTotalCampaignStatistics(\Slavlee\Advertising\Domain\Model\Campaign $campaign) : \stdClass
	{
		$banners = $campaign->getBanners();
		$totalStatistic = new \stdClass();
		$totalStatistic->priority = 0;
		$totalStatistic->delivered = 0;
		$totalStatistic->clicked = 0;
		$totalStatistic->beenVisible = 0;
		
		foreach($banners as $banner)
		{
			$campaignStatistic = $this->findOrCreateCampaignStatisticForBanner($campaign, $banner, true);
			
			if ($campaignStatistic)
			{
				$totalStatistic->delivered += $campaignStatistic->getDelivered();
				$totalStatistic->clicked += $campaignStatistic->getClicked();
				$totalStatistic->beenVisible += $campaignStatistic->getBeenVisible();
				
				// we save the highest priority
				if ($totalStatistic->priority < $campaignStatistic->getPriority())
				{
					$totalStatistic->priority = $campaignStatistic->getPriority();
				}
			}
		}
		
		$totalStatistic->ctr = GeneralStatistic::ctr($totalStatistic->clicked, $totalStatistic->delivered) . '%';

		$this->lastReturnValue = $totalStatistic;
		
		return $totalStatistic;
	}
}