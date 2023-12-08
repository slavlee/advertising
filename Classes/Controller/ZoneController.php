<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Controller;

use Slavlee\Advertising\Domain\Repository\ZoneRepository;
use Slavlee\Advertising\Domain\Repository\BannerRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Slavlee\Advertising\Utility\DebugUtility;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
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
	 * @var \Slavlee\Advertising\Domain\Repository\ZoneRepository
	 */
	protected $zoneRepository;
	
	/**
	 * $bannerRepository
	 * @var \Slavlee\Advertising\Domain\Repository\BannerRepository
	 */
	protected $bannerRepository;
	
	/********************************************************
	 * INJECTIONS - START
	 *******************************************************/
	/**
	 * Inject $zoneRepository
	 * @param \Slavlee\Advertising\Domain\Repository\ZoneRepository $zoneRepository
	 */
	public function injectZoneRepository(ZoneRepository $zoneRepository)
	{
		$this->zoneRepository = $zoneRepository;
		$this->zoneRepository->disableStorage();
	}
	
	/**
	 * Inject $bannerRepository
	 * @param \Slavlee\Advertising\Domain\Repository\BannerRepository $bannerRepository
	 */
	public function injectBannerRepository(BannerRepository $bannerRepository)
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
   	public function showAction(): ResponseInterface
   	{   		   		   	
   		$zone = $this->zoneRepository->findByUid((int)$this->settings['zone']);
   		   		
   		$this->view->assign('zone', $this->zoneRepository->findByUid($this->settings['zone']));
     return $this->htmlResponse();
   	}
}