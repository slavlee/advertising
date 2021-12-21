<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Service;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

class BaseService
{
	/**
	 * ext_conf_template data of advertisement
	 * @var array
	 */
	protected $extConf = [];
	
	/**
	 * Create a BaseService
	 * @return void
	 */
	public function __construct()
	{
		$this->extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)
		->get('advertisement');
	}
	
	/**
	 * Execute the service
	 * @param string $methodName, Name of the method that is being called
	 * @param mixed $arguments, method arguments
	 * @return boolean, RETURNs true if successfully executed
	 */
	public function execute($methodName, ...$arguments)
	{
		if (method_exists($this, $methodName))
		{
			$this->$methodName(...$arguments);
			return true;
		}
		
		return FALSE;
	}
}