<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\DataProcessing\Banner;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

class DeliveredProcessor implements DataProcessorInterface
{
	/**
	 * Execute the processor
	 * @param ContentObjectRenderer $cObj
	 * @param array $contentObjectConfiguration
	 * @param array $processorConfiguration
	 * @param array $processedData
	 * @return array
	 */
	public function process (ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData) : array
	{
		// IF Function Support
		if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
	        // leave $processedData unchanged in case there were previous other processors
	    	return $processedData;
		}
		
		if ($cObj->data['CType'] == 'advertisement_banner')
		{
			// Track delivery
			// I disable it, because it is incurate. Due cache the processor is not guaranteed
			// to be called on every request
// 			$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
// 			$campaignStatisticService = $objectManager->get(\Slavlee\Advertisement\Service\Campaign\StatisticService::class);
// 			$campaignStatisticService->execute('delivered', $cObj->data);
			
			// Add typeNums
			$extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('advertisement');
			$processedData['settings']['typeNums'] = $extConf['general']['typeNums'];
			$processedData['settings']['currentPageUid'] = $GLOBALS['TSFE']->id;
		}
      
		return $processedData;
	}
}