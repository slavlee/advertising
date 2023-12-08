<?php
declare(strict_types=1);

namespace Slavlee\Advertising\ViewHelpers\Banner;

use Slavlee\Advertising\Domain\Repository\BannerRepository;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractConditionViewHelper;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * CampaignStatistic
 */
class IsActiveViewHelper extends AbstractConditionViewHelper
{
	protected $escapeOutput = false;
	protected $escapeChildren = false;
	
	/**
	 * $bannerRepository
	 * @var \Slavlee\Advertising\Domain\Repository\BannerRepository
	 */
	protected $bannerRepository;
	
	/***********************************************************************************
	 * INJECTIONS - START
	 **********************************************************************************/
	/**
	 * Inject $bannerRepository
	 * @param \Slavlee\Advertising\Domain\Repository\CampaignStatisticRepository $bannerRepository
	 * @return void
	 */
	public function injectCampaignStatisticRepository(BannerRepository $bannerRepository)
	{
		$this->bannerRepository = $bannerRepository;
	}
	/***********************************************************************************
	 * INJECTIONS - END
	 **********************************************************************************/
	
	/**
	 * Register arguments
	 */
	public function initializeArguments()
	{
		$this->registerArgument('data', 'array', 'tt_content data of CType: advertising_banner', true);				
	}
	
	/**
	 * Render the ViewHelper
	 * @return string
	 */
	public function render()
	{
		$this->bannerRepository->disableStorage();
		/**
		 * @var \Slavlee\Advertising\Domain\Model\Banner
		 */
		$banner = $this->getBanner();
		
		if ($banner && $banner->hasActiveCampaign())
		{
			return $this->renderThenChild();
		}
		
		return $this->renderElseChild();
	}
	
	/**
	 * Fetch Banner object
	 * @return \Slavlee\Advertising\Domain\Model\Banner
	 */
	protected function getBanner()
	{
		return $this->bannerRepository->findByUid($this->arguments['data']['uid']);
	}
}