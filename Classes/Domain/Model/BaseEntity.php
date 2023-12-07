<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Domain\Model;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * BaseEntity
 */
class BaseEntity extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * Create an instance of current object with given
	 * default values
	 * @param array $defaults
	 * @param string $className
	 * @return \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
	 */
	public static function makeInstance(array $defaults, $className): \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
	{
		$entity = GeneralUtility::makeInstance($className);
	
		foreach($defaults as $propName => $value)
		{
			$methodName = 'set' . ucfirst($propName);
			
			if (method_exists($entity, $methodName))
			{
				$entity->$methodName($value);
			}
		}
		
		return $entity;
	}
}
