<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
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


class BaseActionController extends ActionController
{
	/**
	 * ext_conf_template data of advertising
	 * @var array
	 */
	protected $extConf = [];
	
	/**
	 * Create a BaseService
	 * @return void
	 */
	public function initializeAction()
	{
		$this->extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)
		->get('advertising');
	}
}