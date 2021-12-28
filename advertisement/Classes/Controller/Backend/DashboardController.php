<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Controller\Backend;

use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Slavlee\Advertisement\Controller\BaseActionController;

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
	 * @return void
	 */
	public function __construct(ModuleTemplateFactory $moduleTemplateFactory) {
		$this->moduleTemplateFactory = $moduleTemplateFactory;
	}
	
	/**
	 * Inject $campaignRepository
	 * @param \Slavlee\Advertisement\Domain\Repository\CampaignRepository $campaignRepository
	 * @return void
	 */
	public function injectCampaignRepository(\Slavlee\Advertisement\Domain\Repository\CampaignRepository $campaignRepository)
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
	public function initializeCampaignAction()
	{
		$this->campaignRepository->setStorage((int)$this->extConf['general']['storagePid']);
	}
	
	/**
	 * Init showAction
	 * @return void
	 */
	public function initializeShowAction()
	{
		$this->campaignRepository->setStorage((int)$this->extConf['general']['storagePid']);
	}
	/********************************************************
	 * INIT - START
	 *******************************************************/
	/**
	 * Dashboard of Backend Module: adverisement
	 * @return string 
	 */
   	public function showAction()
   	{   		 
   		//Prepare View   		
   		$this->view->assign('campaigns', $this->campaignRepository->findAllIgnoreEnableFields(['disabled', 'endtime', 'starttime']));
   		
   		// Render Backend View
   		$moduleTemplate = $this->moduleTemplateFactory->create($this->request);
   		$moduleTemplate->setContent($this->view->render());
   		return $this->htmlResponse($moduleTemplate->renderContent());
   	}
   	
   	/**
   	 * Campaign view in Dashboard of Backend Module: adverisement
   	 * @param \Slavlee\Advertisement\Domain\Model\Campaign $campaign
   	 * @return string
   	 */
   	public function campaignAction($campaign)
   	{
   		//Prepare View
   		$this->view->assign('campaign', $this->campaignRepository->findByUidIgnoreEnableFields($campaign->getUid(), ['disabled', 'endtime', 'starttime'])->current());
   		 
   		// Render Backend View
   		$moduleTemplate = $this->moduleTemplateFactory->create($this->request);
   		$moduleTemplate->setContent($this->view->render());
   		return $this->htmlResponse($moduleTemplate->renderContent());
   	}
}