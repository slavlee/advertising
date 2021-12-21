<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Service\Campaign;

use Slavlee\Advertisement\Domain\Model\CampaignStatistic;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

class StatisticService extends \Slavlee\Advertisement\Service\BaseService
{
	/**
	 * $bannerRepository
	 * @var \Slavlee\Advertisement\Domain\Repository\BannerRepository
	 */
	protected $bannerRepository;
	
	/**
	 * $campaignRepository
	 * @var \Slavlee\Advertisement\Domain\Repository\CampaignRepository
	 */
	protected $campaignRepository;
	
	/**
	 * $campaignStatisticRepository
	 * @var \Slavlee\Advertisement\Domain\Repository\CampaignStatisticRepository
	 */
	protected $campaignStatisticRepository;
	
	/***********************************************************************************
	 * INJECTIONS - START
	 **********************************************************************************/
	/**
	 * Inject $bannerRepository
	 * @param \Slavlee\Advertisement\Domain\Repository\BannerRepository $bannerRepository
	 * @return void
	 */
	public function injectBannerRepository(\Slavlee\Advertisement\Domain\Repository\BannerRepository $bannerRepository)
	{
		$this->bannerRepository = $bannerRepository;
		$this->bannerRepository->setStorage($this->extConf['general']['storagePid']);
	}
	
	/**
	 * Inject $campaignRepository
	 * @param \Slavlee\Advertisement\Domain\Repository\CampaignRepository $campaignRepository
	 * @return void
	 */
	public function injectCampaignRepository(\Slavlee\Advertisement\Domain\Repository\CampaignRepository $campaignRepository)
	{
		$this->campaignRepository = $campaignRepository;
		$this->campaignRepository->setStorage($this->extConf['general']['storagePid']);
	}
	
	/**
	 * Inject $campaignStatisticRepository
	 * @param \Slavlee\Advertisement\Domain\Repository\CampaignStatisticRepository $campaignStatisticRepository
	 * @return void
	 */
	public function injectCampaignStatisticRepository(\Slavlee\Advertisement\Domain\Repository\CampaignStatisticRepository $campaignStatisticRepository)
	{
		$this->campaignStatisticRepository = $campaignStatisticRepository;
		$this->campaignStatisticRepository->setStorage($this->extConf['general']['storagePid']);
	}
	/***********************************************************************************
	 * INJECTIONS - END
	 **********************************************************************************/
	
	/**
	 * Save click event on given banner
	 * @param \Slavlee\Advertisement\Domain\Model\Banner $banner
	 * @return void
	 */
	protected function clickedForBanner(\Slavlee\Advertisement\Domain\Model\Banner $banner)
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
		}
	}
	
	/**
	 * get all active campaigns for given content element
	 * @param \Slavlee\Advertisement\Domain\Model\Banner $banner
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	protected function findCampaignsForBanner(\Slavlee\Advertisement\Domain\Model\Banner $banner) : \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	{
		return $this->campaignRepository->findCampaignsForBanner($banner);
	}
	
	/**
	 * get or create campaign statistic object
	 * @param \Slavlee\Advertisement\Domain\Model\Campaign $campaign
	 * @param \Slavlee\Advertisement\Domain\Model\Banner $banner
	 * @return \Slavlee\Advertisement\Domain\Model\CampaignStatistic
	 */
	protected function findOrCreateCampaignStatisticForBanner(\Slavlee\Advertisement\Domain\Model\Campaign $campaign, \Slavlee\Advertisement\Domain\Model\Banner $banner) : \Slavlee\Advertisement\Domain\Model\CampaignStatistic
	{
		$campaignStatistic = $this->campaignStatisticRepository->findByCampaignAndBanner($campaign, $banner)->current();
		
		if (!$campaignStatistic)
		{
			$campaignStatistic = CampaignStatistic::makeInstance(['pid' => (int)$this->extConf['general']['storagePid'], 'banner' => $banner, 'campaign' => $campaign], CampaignStatistic::class);
		}
		
		return $campaignStatistic;
	}
}