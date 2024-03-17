<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Utility;

use TYPO3\CMS\Extbase\Object\ObjectManager;
/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */
class GeneralUtility
{
	/**
	 * Executes objectManager->get
	 * @param string $class
	 * @param array ...$arguments
	 * @return object
	 */
	public static function makeInstance($class, ...$arguments)
	{
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ObjectManager::class);
		return $objectManager->get($class, ...$arguments);
	}
}