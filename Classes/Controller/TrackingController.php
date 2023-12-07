<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Slavlee\Advertising\Utility\DebugUtility;
use TYPO3\CMS\Frontend\Service\TypoLinkCodecService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
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
	 * @var \Slavlee\Advertising\Service\Campaign\StatisticService
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
	 * @param \Slavlee\Advertising\Domain\Model\Banner $banner
	 * @return string 
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("banner")
	 */
   	public function clickAction(\Slavlee\Advertising\Domain\Model\Banner $banner)
   	{   		   		
   		$service = $this->objectManager->get(\Slavlee\Advertising\Service\Campaign\StatisticService::class);
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
   	
   	/**
   	 * Delivered tracking for given banner
   	 * @param \Slavlee\Advertising\Domain\Model\Banner $banner
   	 * @return string
   	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("banner")
   	 */
   	public function deliveredAction(\Slavlee\Advertising\Domain\Model\Banner $banner)
   	{
   		$state = 'success';
   		$data = [];
   		$service = $this->objectManager->get(\Slavlee\Advertising\Service\Campaign\StatisticService::class);
   		$service->execute('deliveredForBanner', $banner);
   		
   		// Create json response
   		$this->view->setConfiguration([
		    'response' => [
		        '_only' => [
		            'state',
		            'data',
		        ],
		    ],
		]);
		
		$this->view->setVariablesToRender(['response']);
		
		$this->view->assign('response', [
		    'state' => $state,
		    'data' => $data]
		);
   	}
}