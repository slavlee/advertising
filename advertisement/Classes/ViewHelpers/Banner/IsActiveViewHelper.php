<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\ViewHelpers\Banner;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractConditionViewHelper;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
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
	 * @var \Slavlee\Advertisement\Domain\Repository\BannerRepository
	 */
	protected $bannerRepository;
	
	/***********************************************************************************
	 * INJECTIONS - START
	 **********************************************************************************/
	/**
	 * Inject $bannerRepository
	 * @param \Slavlee\Advertisement\Domain\Repository\CampaignStatisticRepository $bannerRepository
	 * @return void
	 */
	public function injectCampaignStatisticRepository(\Slavlee\Advertisement\Domain\Repository\BannerRepository $bannerRepository)
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
		$this->registerArgument('data', 'array', 'tt_content data of CType: advertisement_banner', true);				
	}
	
	/**
	 * Render the ViewHelper
	 * @return string
	 */
	public function render()
	{
		$this->bannerRepository->disableStorage();
		/**
		 * @var \Slavlee\Advertisement\Domain\Model\Banner
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
	 * @return \Slavlee\Advertisement\Domain\Model\Banner
	 */
	protected function getBanner()
	{
		return $this->bannerRepository->findByUid($this->arguments['data']['uid']);
	}
}