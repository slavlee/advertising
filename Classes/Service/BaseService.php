<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Service;

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

class BaseService
{
	/**
	 * ext_conf_template data of advertising
	 * @var array
	 */
	protected $extConf = [];
	
	/**
	 * $lastReturnValue, stores the value of the last execute function
	 * @var string|array|object
	 */
	protected $lastReturnValue = null;
	
	/**
	 * Create a BaseService
	 * @return void
	 */
	public function __construct()
	{
		$this->extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)
		->get('advertising');
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
			$this->lastReturnValue = $this->$methodName(...$arguments);
			return true;
		}
		
		return FALSE;
	}
	
	/**
	 * Returns the value of the last execute function
	 * @return string|object
	 */
	public function getLastReturnValue()
	{
		return $this->lastReturnValue;
	}
}