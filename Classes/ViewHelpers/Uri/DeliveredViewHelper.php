<?php
declare(strict_types=1);

namespace Slavlee\Advertising\ViewHelpers\Uri;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;

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
class DeliveredViewHelper extends AbstractViewHelper
{	
	public function __construct(
        private readonly UriBuilder $uriBuilder
    ) {}


	/**
	 * Register arguments
	 */
	public function initializeArguments()
	{
		parent::initializeArguments();
		$this->registerArgument('banner', 'int', 'UID of the content element that acts like a banner', true);
	}
	
	/**
	 * Render the ViewHelper
	 * @return string
	 */
	public function render()
	{
		$extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('advertising');
		$typeNum = (int)$extConf['general']['typeNums']['deliveredTracking'];

		if (empty($typeNum)) {
			return '';
		}

		return $this->uriBuilder->reset()->setTargetPageType($typeNum)->setArguments(
			['tx_advertising_deliveredtracking' => [
				'banner' => $this->arguments['banner']
			]]
		)->build();
	}
}