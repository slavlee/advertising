<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

class DebugUtility
{
	public static function debugQuery($query)
	{
		$objectManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
		$queryParser = $objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
		$parameters = $queryParser->convertQueryToDoctrineQueryBuilder($query)->getParameters();
		$sql = $queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL();
		
		foreach($parameters as $placeholder => $value)
		{
			$sql = preg_replace('/:' . $placeholder . '/', $value, $sql, 1);
		}
		
		if ($query->getLimit() && $query->getOffset())
		{
			$sql .= ' LIMIT ' . $query->getOffset() . ',' . $query->getLimit();
		}else if($query->getLimit())
		{
			$sql .= ' LIMIT ' . $query->getLimit();
		}
		
		var_dump($sql);
	}
}