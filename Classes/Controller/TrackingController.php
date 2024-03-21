<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Controller;

use TYPO3\CMS\Extbase\Mvc\View\JsonView;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use Slavlee\Advertising\Domain\Model\Banner;
use Psr\Http\Message\ResponseInterface;
use Slavlee\Advertising\Service\Campaign\StatisticService;
use TYPO3\CMS\Core\LinkHandling\TypoLinkCodecService;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
	protected $defaultViewObjectName = JsonView::class;
	
	/**
	 * $statisticService
	 * @var \Slavlee\Advertising\Service\Campaign\StatisticService
	 */
	protected $statisticService;

	public function __construct(StatisticService $statisticService) {
		$this->statisticService = $statisticService;
	}
	
    /**
     * Clicktracking for given banner
     * @param \Slavlee\Advertising\Domain\Model\Banner $banner
     * @return string
     */
    #[IgnoreValidation(['value' => 'banner'])]
    public function clickAction(Banner $banner): ResponseInterface
   	{   		   		
   		$this->statisticService->execute('clickedForBanner', $banner);
   		
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
		return $this->redirectToUri($contentObject->typoLink_URL($instructions));
   	}
   	
   	/**
     * Delivered tracking for given banner
     * @param \Slavlee\Advertising\Domain\Model\Banner $banner
     * @return string
     */
    #[IgnoreValidation(['value' => 'banner'])]
    public function deliveredAction(Banner $banner): ResponseInterface
   	{
   		$state = 'success';
   		$data = [];
   		$this->statisticService->execute('deliveredForBanner', $banner);
   		
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
  		return $this->htmlResponse();
   	}
}