<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Slavlee\Advertisement\Utility\DebugUtility;
use TYPO3\CMS\Frontend\Service\TypoLinkCodecService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */


class TrackingController extends ActionController
{
	protected $defaultViewObjectName = \TYPO3\CMS\Extbase\Mvc\View\JsonView::class;
	
	/**
	 * $statisticService
	 * @var \Slavlee\Advertisement\Service\Campaign\StatisticService
	 */
	protected $statisticService;
	
	/********************************************************
	 * INJECTIONS - START
	 *******************************************************/

	/********************************************************
	 * INJECTIONS - END
	 *******************************************************/
	
	/**
	 * Clicktracking for given banner
	 * @param \Slavlee\Advertisement\Domain\Model\Banner $banner
	 * @return string 
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("banner")
	 */
   	public function clickAction(\Slavlee\Advertisement\Domain\Model\Banner $banner)
   	{   		   		
   		$service = $this->objectManager->get(\Slavlee\Advertisement\Service\Campaign\StatisticService::class);
   		$service->execute('clickedForBanner', $banner);
   		
   		// We dont send a JSON response, we simply redirect to target uri
   		
   		// Build typolink
   		$typoLinkCodec = GeneralUtility::makeInstance(TypoLinkCodecService::class);
		$typoLinkConfiguration = $typoLinkCodec->decode($banner->getLink());
		$typoLinkParameter = $typoLinkCodec->encode($typoLinkConfiguration);
		
		$instructions = [
			'parameter' => $typoLinkParameter,
			'forceAbsoluteUrl' => '1',
		];
		
		$contentObject = GeneralUtility::makeInstance(ContentObjectRenderer::class);
   		
		// Redirect
		\TYPO3\CMS\Core\Utility\HttpUtility::redirect($contentObject->typoLink_URL($instructions));
   	}
}