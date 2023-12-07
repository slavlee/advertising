<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

class DebugUtility
{
	/**
	 * Debug Query
	 * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
	 * @return void
	 */
	public static function debugQuery(\TYPO3\CMS\Extbase\Persistence\Generic\Query $query): void
	{
		$objectManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
		$queryParser = $objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
		$queryBuilder = $queryParser->convertQueryToDoctrineQueryBuilder($query);
		
		self::debugQueryBuilder($queryBuilder, $query->getLimit(), $query->getOffset());
	}
	
	/**
	 * Debug QueryBuilder
	 * @param \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder
	 * @param int $limit
	 * @param int $offset
	 * @return void
	 */
	public static function debugQueryBuilder(\TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder, $limit = FALSE, $offset = FALSE): void
	{
		$parameters = $queryBuilder->getParameters();
		$sql = $queryBuilder->getSQL();
		
		foreach($parameters as $placeholder => $value)
		{
			$sql = preg_replace('/:' . $placeholder . '/', $value, $sql, 1);
		}
		
		if ($query)
		{
			if ($limit && $offset)
			{
				$sql .= ' LIMIT ' . $query->getOffset() . ',' . $query->getLimit();
			}else if($limit)
			{
				$sql .= ' LIMIT ' . $query->getLimit();
			}
		}
		
		var_dump($sql);
	}
}