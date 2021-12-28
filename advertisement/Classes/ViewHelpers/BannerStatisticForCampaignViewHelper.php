<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
class BannerStatisticForCampaignViewHelper extends AbstractViewHelper
{
	protected $escapeOutput = false;
	protected $escapeChildren = false;
	
	/**
	 * $bannerStatisticRepository
	 * @var \Slavlee\Advertisement\Domain\Repository\BannerStatisticRepository
	 */
	protected $bannerStatisticRepository;
	
	/***********************************************************************************
	 * INJECTIONS - START
	 **********************************************************************************/
	/**
	 * Inject $bannerStatisticRepository
	 * @param \Slavlee\Advertisement\Domain\Repository\BannerStatisticRepository $bannerStatisticRepository
	 * @return void
	 */
	public function injectCampaignStatisticRepository(\Slavlee\Advertisement\Domain\Repository\BannerStatisticRepository $bannerStatisticRepository)
	{
		$this->bannerStatisticRepository = $bannerStatisticRepository;
		$this->bannerStatisticRepository->setStorage($this->extConf['general']['storagePid']);
	}
	/***********************************************************************************
	 * INJECTIONS - END
	 **********************************************************************************/
	
	/**
	 * Register arguments
	 */
	public function initializeArguments()
	{
		parent::initializeArguments();
		$this->registerArgument('campaign', \Slavlee\Advertisement\Domain\Model\Campaign::class, 'Campaign entity', true);
		$this->registerArgument('banner', \Slavlee\Advertisement\Domain\Model\Banner::class, 'Banner entity', true);
		$this->registerArgument('as', 'string', 'Name of the template variable, where the statistic is stored', true);				
	}
	
	/**
	 * Render the ViewHelper
	 * @return string
	 */
	public function render()
	{
		$extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('advertisement');
		$this->bannerStatisticRepository->setStorage($extConf['general']['storagePid']);
		
		$campaignStatistic = $this->bannerStatisticRepository->findByBannerAndCampaign($this->arguments['banner'], $this->arguments['campaign'])->current();
		
		if ($this->templateVariableContainer->exists($this->arguments['as']))
		{
			$this->templateVariableContainer->remove($this->arguments['as']);
		}
						
		$this->templateVariableContainer->add($this->arguments['as'], $campaignStatistic);
		
		return $this->renderChildren();
	}
}