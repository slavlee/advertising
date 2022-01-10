<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Controller\Backend;

use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use Slavlee\Advertisement\Controller\BaseActionController;
use Psr\Http\Message\ResponseInterface;
use Slavlee\Advertisement\Domain\Model\Dashboard\Demand\CampaignDemand;
use Slavlee\Advertisement\Utility\GeneralUtility;
use Slavlee\Advertisement\Utility\DebugUtility;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */


class DashboardController extends BaseActionController
{
	/**
	 * @var ModuleTemplateFactory $moduleTemplateFactory
	 */
	protected $moduleTemplateFactory;
	
	/**
	 * $campaignRepository
	 * @var \Slavlee\Advertisement\Domain\Repository\CampaignRepository
	 */
	protected $campaignRepository;
	
	/********************************************************
	 * INJECTIONS - START
	 *******************************************************/
	/**
	 * Create a DashboardController
	 * @param ModuleTemplateFactory $moduleTemplateFactory
	 */
	public function __construct(ModuleTemplateFactory $moduleTemplateFactory) {
		$this->moduleTemplateFactory = $moduleTemplateFactory;
	}
	
	/**
	 * Inject $campaignRepository
	 * @param \Slavlee\Advertisement\Domain\Repository\CampaignRepository $campaignRepository
	 * @return void
	 */
	public function injectCampaignRepository(\Slavlee\Advertisement\Domain\Repository\CampaignRepository $campaignRepository): void
	{
		$this->campaignRepository = $campaignRepository;
	}
	/********************************************************
	 * INJECTIONS - END
	 *******************************************************/
	
	/********************************************************
	 * INIT - START
	 *******************************************************/
	/**
	 * Init showAction
	 * @return void
	 */
	public function initializeCampaignAction(): void
	{
		$this->campaignRepository->setStorage((int)$this->extConf['general']['storagePid']);
		
		$this->settings['dateFormat'] = $GLOBALS['TYPO3_CONF_VARS']['SYS']['ddmmyy'] . ' ' . $GLOBALS['TYPO3_CONF_VARS']['SYS']['hhmm'];
	}
	
	/**
	 * Init showAction
	 * @return void
	 */
	public function initializeShowAction(): void
	{
		$this->campaignRepository->setStorage((int)$this->extConf['general']['storagePid']);
		
		$this->settings['dateFormat'] = $GLOBALS['TYPO3_CONF_VARS']['SYS']['ddmmyy'] . ' ' . $GLOBALS['TYPO3_CONF_VARS']['SYS']['hhmm'];
	}
	
	/**
	 * Init showAction
	 * @return void
	 */
	public function initializeRecalculateCampaignStatisticAction(): void
	{
		$this->campaignRepository->setStorage((int)$this->extConf['general']['storagePid']);
	}
	/********************************************************
	 * INIT - START
	 *******************************************************/
	/**
	 * Dashboard of Backend Module: adverisement
	 * @param \Slavlee\Advertisement\Domain\Model\Dashboard\Demand\CampaignDemand $demand
	 * @param array $pagination
	 * @return ResponseInterface 
	 */
   	public function showAction(\Slavlee\Advertisement\Domain\Model\Dashboard\Demand\CampaignDemand $demand = null, $pagination = []): ResponseInterface
   	{   	
   		// Set start pagination
   		if (empty($pagination))
   		{
   			$pagination = ['entriesPerStep' => 10, 'currentStep' => 1];
   		}
   		
   		// if we have to demand object, then create one
   		if (!$demand)
   		{
   			$demand = $this->objectManager->get(CampaignDemand::class);
   		}
   		
   		// ignore always these enabled fields
   		$demand->setEnabledFieldsToBeIgnored(['disabled', 'endtime', 'starttime']);
   		
   		// Statistic object for dashboard overview
   		$campaigns = $this->campaignRepository->findDemanded($demand);   		
   		$statistic = $this->objectManager->get(\Slavlee\Advertisement\Statistic\CampaignStatistic::class, $campaigns);
   		
   		// Do pagination
   		if (!empty($pagination))
   		{
   			$paginateHelper = GeneralUtility::makeInstance(\Slavlee\Advertisement\Helper\PaginateHelper::class, $pagination);
   			$query = $paginateHelper->paginate($campaigns->getQuery(), $pagination['currentStep']);
   			
   			$campaigns = $query->execute();
   		}
   		
   		//Prepare View   		
   		$this->view->assign('paginateHelper', $paginateHelper);
   		$this->view->assign('statistic', $statistic);
   		$this->view->assign('campaigns', $campaigns);
   		$this->view->assign('demand', $demand);
   		$pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
   		$pageRenderer->addCssFile('EXT:advertisement/Resources/Public/Contrib/FontAwesome/css/all.min.css');
   		$pageRenderer->addCssFile('EXT:advertisement/Resources/Public/Css/Backend/dashboard.css');
   		
   		// Render Backend View
   		$moduleTemplate = $this->moduleTemplateFactory->create($this->request);
   		$moduleTemplate->setContent($this->view->render());
   		return $this->htmlResponse($moduleTemplate->renderContent());
   	}
   	
   	/**
   	 * Campaign view in Dashboard of Backend Module: adverisement
   	 * @param integer $campaign
   	 * @return ResponseInterface
   	 */
   	public function campaignAction($campaign): ResponseInterface
   	{
   		// Campaign must be integer, because QueryRestrictions 
   		// prevent creating the model and we still want
   		// hidden or past campaigns too
		// That's why we fetch it manually without QueryRestrictions
   		$campaign = $this->campaignRepository->findByUidIgnoreEnableFields($campaign, ['disabled', 'endtime', 'starttime'])->current();
   		
   		//Prepare View
   		$this->view->assign('campaign', $campaign);
		   		 
   		// Render Backend View
   		$moduleTemplate = $this->moduleTemplateFactory->create($this->request);
   		$moduleTemplate->setContent($this->view->render());
   		return $this->htmlResponse($moduleTemplate->renderContent());
   	}
   	
   	/**
   	 * Recalculate all campaign statistics
   	 * @param \Slavlee\Advertisement\Domain\Model\Dashboard\Demand\CampaignDemand $demand
   	 * @param array $pagination
   	 * @return void
   	 */
   	public function recalculateCampaignStatisticAction(): void
   	{
   		$demand = $this->objectManager->get(CampaignDemand::class);
   		 
   		// ignore always these enabled fields
   		$demand->setEnabledFieldsToBeIgnored(['disabled', 'endtime', 'starttime']);
   		
   		// find campaigns
   		$campaigns = $this->campaignRepository->findDemanded($demand);
   		
   		// Recalculate
   		foreach($campaigns as $campaign)
   		{
   			/**
   			 * @var \Slavlee\Advertisement\Service\Campaign\StatisticService $service
   			 */
   			$service = $this->objectManager->get(\Slavlee\Advertisement\Service\Campaign\StatisticService::class);
   			$service->execute('recalculateCampaignStatisticsWithTrackerData', $campaign);
   		}
   		
   		$this->redirect('show');
   	}
}