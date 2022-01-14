<?php
declare(strict_types=1);

namespace Slavlee\Advertising\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
class CampaignStatisticViewHelper extends AbstractViewHelper
{
	protected $escapeOutput = false;
	protected $escapeChildren = false;
	
	/**
	 * $campaignStatisticRepository
	 * @var \Slavlee\Advertising\Domain\Repository\CampaignStatisticRepository
	 */
	protected $campaignStatisticRepository;
	
	/***********************************************************************************
	 * INJECTIONS - START
	 **********************************************************************************/
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
	/***********************************************************************************
	 * INJECTIONS - END
	 **********************************************************************************/
	
	/**
	 * Register arguments
	 */
	public function initializeArguments()
	{
		parent::initializeArguments();
		$this->registerArgument('campaign', \Slavlee\Advertising\Domain\Model\Campaign::class, 'Campaign entity', true);
		$this->registerArgument('banner', \Slavlee\Advertising\Domain\Model\Banner::class, 'Banner entity', true);
		$this->registerArgument('as', 'string', 'Name of the template variable, where the statistic is stored', true);				
	}
	
	/**
	 * Render the ViewHelper
	 * @return string
	 */
	public function render()
	{
		$extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('advertising');
		$this->campaignStatisticRepository->setStorage($extConf['general']['storagePid']);
		
		$campaignStatistic = $this->campaignStatisticRepository->findByCampaignAndBanner($this->arguments['campaign'], $this->arguments['banner']);
		
		if ($this->templateVariableContainer->exists($this->arguments['as']))
		{
			$this->templateVariableContainer->remove($this->arguments['as']);
		}
				
		$this->templateVariableContainer->add($this->arguments['as'], $campaignStatistic);
		
		return $this->renderChildren();
	}
}