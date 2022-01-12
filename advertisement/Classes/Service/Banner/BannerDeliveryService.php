<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Service\Banner;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

class BannerDeliveryService extends \Slavlee\Advertisement\Service\BaseService
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
	/***********************************************************************************
	 * INJECTIONS - END
	 **********************************************************************************/
	
	/**
	 * Returns an array of all banners that are assigned to at least one active campaign
	 * @param \Slavlee\Advertisement\Domain\Model\Zone $zone
	 * @return array
	 */
	public function getBannersFromActiveCampaignsForZone(\Slavlee\Advertisement\Domain\Model\Zone $zone): array
	{
		return $this->bannerRepository->findFromActiveCampaignsForZone($zone)->fetchAll();
	}
}