<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Service\Banner;

use Slavlee\Advertising\Service\BaseService;
use Slavlee\Advertising\Domain\Repository\BannerRepository;
use Slavlee\Advertising\Domain\Repository\CampaignRepository;
use Slavlee\Advertising\Domain\Model\Zone;
/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */
class BannerDeliveryService extends BaseService
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
	
	/***********************************************************************************
	 * INJECTIONS - START
	 **********************************************************************************/
	/**
	 * Inject $bannerRepository
	 * @param \Slavlee\Advertising\Domain\Repository\BannerRepository $bannerRepository
	 * @return void
	 */
	public function injectBannerRepository(BannerRepository $bannerRepository)
	{
		$this->bannerRepository = $bannerRepository;
		$this->bannerRepository->setStorage($this->extConf['general']['storagePid']);
	}
	
	/**
	 * Inject $campaignRepository
	 * @param \Slavlee\Advertising\Domain\Repository\CampaignRepository $campaignRepository
	 * @return void
	 */
	public function injectCampaignRepository(CampaignRepository $campaignRepository)
	{
		$this->campaignRepository = $campaignRepository;
		$this->campaignRepository->setStorage($this->extConf['general']['storagePid']);
	}
	/***********************************************************************************
	 * INJECTIONS - END
	 **********************************************************************************/
	
	/**
	 * Returns an array of all banners that are assigned to at least one active campaign
	 * @param \Slavlee\Advertising\Domain\Model\Zone $zone
	 * @return array
	 */
	public function getBannersFromActiveCampaignsForZone(Zone $zone): array
	{
		return $this->bannerRepository->findFromActiveCampaignsForZone($zone)->fetchAll();
	}
}