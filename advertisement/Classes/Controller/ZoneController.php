<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Slavlee\Advertisement\Utility\DebugUtility;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */


class ZoneController extends ActionController
{
	/**
	 * $zoneRepository
	 * @var \Slavlee\Advertisement\Domain\Repository\ZoneRepository
	 */
	protected $zoneRepository;
	
	/**
	 * $bannerRepository
	 * @var \Slavlee\Advertisement\Domain\Repository\BannerRepository
	 */
	protected $bannerRepository;
	
	/********************************************************
	 * INJECTIONS - START
	 *******************************************************/
	/**
	 * Inject $zoneRepository
	 * @param \Slavlee\Advertisement\Domain\Repository\ZoneRepository $zoneRepository
	 */
	public function injectZoneRepository(\Slavlee\Advertisement\Domain\Repository\ZoneRepository $zoneRepository)
	{
		$this->zoneRepository = $zoneRepository;
		$this->zoneRepository->disableStorage();
	}
	
	/**
	 * Inject $bannerRepository
	 * @param \Slavlee\Advertisement\Domain\Repository\BannerRepository $bannerRepository
	 */
	public function injectBannerRepository(\Slavlee\Advertisement\Domain\Repository\BannerRepository $bannerRepository)
	{
		$this->bannerRepository = $bannerRepository;
		$this->bannerRepository->disableStorage();
	}
	/********************************************************
	 * INJECTIONS - END
	 *******************************************************/
	
	/**
	 * Displays all banner of a given zone
	 * @return string 
	 */
   	public function showAction()
   	{   		   		   	
   		$zone = $this->zoneRepository->findByUid((int)$this->settings['zone']);
   		   		
   		$this->view->assign('zone', $this->zoneRepository->findByUid($this->settings['zone']));
   	}
}