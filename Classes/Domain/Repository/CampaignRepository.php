<?php

declare(strict_types=1);

namespace Slavlee\Advertising\Domain\Repository;


use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use Slavlee\Advertising\Domain\Model\Banner;
use Slavlee\Advertising\Domain\Model\Dashboard\Demand\CampaignDemand;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use Slavlee\Advertising\Utility\DebugUtility;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * The repository for Campaigns
 */
class CampaignRepository extends BaseRepository
{
	/**
  * findAll with enable fields to be ignored
  * @param array $enableFieldsToIgnore
  * @return QueryResult
  */
 public function findAllIgnoreEnableFields(array $enableFieldsToIgnore) : QueryResult
	{
		$query = $this->createQuery();
		$query->getQuerySettings()->setEnableFieldsToBeIgnored($enableFieldsToIgnore);
		$query->getQuerySettings()->setIgnoreEnableFields(true);
// 		DebugUtility::debugQuery($query);
		return $query->execute();
	}
	
	/**
  * findAll with enable fields to be ignored
  * @param integer $uid
  * @param array $enableFieldsToIgnore
  * @return QueryResult
  */
 public function findByUidIgnoreEnableFields($uid, array $enableFieldsToIgnore) : QueryResult
	{
		$query = $this->createQuery();
		$query->getQuerySettings()->setEnableFieldsToBeIgnored($enableFieldsToIgnore);
		$query->getQuerySettings()->setIgnoreEnableFields(true);
		$query->matching(
			$query->equals('uid', $uid)	
		);
		return $query->execute();
	}
	
	/**
  * Find all campaigns for given banner
  * @param \Slavlee\Advertising\Domain\Model\Banner $banner
  * @return QueryResult
  */
 public function findCampaignsForBanner(Banner $banner) : QueryResult
	{
		$query = $this->createQuery();
		$query->matching(
			$query->contains('banners', $banner)
		);
// 		DebugUtility::debugQuery($query);
		return $query->execute();
	}
	
	/**
  * Find all campaigns in given demand context
  * @param \Slavlee\Advertising\Domain\Model\Dashboard\Demand\CampaignDemand $demand
  * @return QueryResult
  */
 public function findDemanded(CampaignDemand $demand)
	{
		// We create query for demand object
		$query = $this->createQuery();
		$demand->setQuery($query);
		
		// we create constraints and query settings
		$constraints = $demand->createConstraints();
		$query->setQuerySettings($demand->createQuerySettings());
		
		if (count($constraints) === 1) {
      $query->matching(reset($constraints));
  } elseif (count($constraints) >= 2) {
      if (count($constraints) === 1) {
          $query->matching(reset($constraints));
      } elseif (count($constraints) >= 2) {
          if (count($constraints) === 1) {
              $query->matching(reset($constraints));
          } elseif (count($constraints) >= 2) {
              if (count($constraints) === 1) {
                  $query->matching(reset($constraints));
              } elseif (count($constraints) >= 2) {
                  if (count($constraints) === 1) {
                      $query->matching(reset($constraints));
                  } elseif (count($constraints) >= 2) {
                      if (count($constraints) === 1) {
                          $query->matching(reset($constraints));
                      } elseif (count($constraints) >= 2) {
                          if (count($constraints) === 1) {
                              $query->matching(reset($constraints));
                          } elseif (count($constraints) >= 2) {
                              if (count($constraints) === 1) {
                                  $query->matching(reset($constraints));
                              } elseif (count($constraints) >= 2) {
                                  if (count($constraints) === 1) {
                                      $query->matching(reset($constraints));
                                  } elseif (count($constraints) >= 2) {
                                      if (count($constraints) === 1) {
                                          $query->matching(reset($constraints));
                                      } elseif (count($constraints) >= 2) {
                                          if (count($constraints) === 1) {
                                              $query->matching(reset($constraints));
                                          } elseif (count($constraints) >= 2) {
                                              if (count($constraints) === 1) {
                                                  $query->matching(reset($constraints));
                                              } elseif (count($constraints) >= 2) {
                                                  if (count($constraints) === 1) {
                                                      $query->matching(reset($constraints));
                                                  } elseif (count($constraints) >= 2) {
                                                      if (count($constraints) === 1) {
                                                          $query->matching(reset($constraints));
                                                      } elseif (count($constraints) >= 2) {
                                                          if (count($constraints) === 1) {
                                                              $query->matching(reset($constraints));
                                                          } elseif (count($constraints) >= 2) {
                                                              if (count($constraints) === 1) {
                                                                  $query->matching(reset($constraints));
                                                              } elseif (count($constraints) >= 2) {
                                                                  if (count($constraints) === 1) {
                                                                      $query->matching(reset($constraints));
                                                                  } elseif (count($constraints) >= 2) {
                                                                      if (count($constraints) === 1) {
                                                                          $query->matching(reset($constraints));
                                                                      } elseif (count($constraints) >= 2) {
                                                                          if (count($constraints) === 1) {
                                                                              $query->matching(reset($constraints));
                                                                          } elseif (count($constraints) >= 2) {
                                                                              if (count($constraints) === 1) {
                                                                                  $query->matching(reset($constraints));
                                                                              } elseif (count($constraints) >= 2) {
                                                                                  if (count($constraints) === 1) {
                                                                                      $query->matching(reset($constraints));
                                                                                  } elseif (count($constraints) >= 2) {
                                                                                      if (count($constraints) === 1) {
                                                                                          $query->matching(reset($constraints));
                                                                                      } elseif (count($constraints) >= 2) {
                                                                                          if (count($constraints) === 1) {
                                                                                              $query->matching(reset($constraints));
                                                                                          } elseif (count($constraints) >= 2) {
                                                                                              if (count($constraints) === 1) {
                                                                                                  $query->matching(reset($constraints));
                                                                                              } elseif (count($constraints) >= 2) {
                                                                                                  if (count($constraints) === 1) {
                                                                                                      $query->matching(reset($constraints));
                                                                                                  } elseif (count($constraints) >= 2) {
                                                                                                      if (count($constraints) === 1) {
                                                                                                          $query->matching(reset($constraints));
                                                                                                      } elseif (count($constraints) >= 2) {
                                                                                                          if (count($constraints) === 1) {
                                                                                                              $query->matching(reset($constraints));
                                                                                                          } elseif (count($constraints) >= 2) {
                                                                                                              if (count($constraints) === 1) {
                                                                                                                  $query->matching(reset($constraints));
                                                                                                              } elseif (count($constraints) >= 2) {
                                                                                                                  if (count($constraints) === 1) {
                                                                                                                      $query->matching(reset($constraints));
                                                                                                                  } elseif (count($constraints) >= 2) {
                                                                                                                      if (count($constraints) === 1) {
                                                                                                                          $query->matching(reset($constraints));
                                                                                                                      } elseif (count($constraints) >= 2) {
                                                                                                                          if (count($constraints) === 1) {
                                                                                                                              $query->matching(reset($constraints));
                                                                                                                          } elseif (count($constraints) >= 2) {
                                                                                                                              if (count($constraints) === 1) {
                                                                                                                                  $query->matching(reset($constraints));
                                                                                                                              } elseif (count($constraints) >= 2) {
                                                                                                                                  if (count($constraints) === 1) {
                                                                                                                                      $query->matching(reset($constraints));
                                                                                                                                  } elseif (count($constraints) >= 2) {
                                                                                                                                      if (count($constraints) === 1) {
                                                                                                                                          $query->matching(reset($constraints));
                                                                                                                                      } elseif (count($constraints) >= 2) {
                                                                                                                                          if (count($constraints) === 1) {
                                                                                                                                              $query->matching(reset($constraints));
                                                                                                                                          } elseif (count($constraints) >= 2) {
                                                                                                                                              if (count($constraints) === 1) {
                                                                                                                                                  $query->matching(reset($constraints));
                                                                                                                                              } elseif (count($constraints) >= 2) {
                                                                                                                                                  if (count($constraints) === 1) {
                                                                                                                                                      $query->matching(reset($constraints));
                                                                                                                                                  } elseif (count($constraints) >= 2) {
                                                                                                                                                      if (count($constraints) === 1) {
                                                                                                                                                          $query->matching(reset($constraints));
                                                                                                                                                      } elseif (count($constraints) >= 2) {
                                                                                                                                                          if (count($constraints) === 1) {
                                                                                                                                                              $query->matching(reset($constraints));
                                                                                                                                                          } elseif (count($constraints) >= 2) {
                                                                                                                                                              if (count($constraints) === 1) {
                                                                                                                                                                  $query->matching(reset($constraints));
                                                                                                                                                              } elseif (count($constraints) >= 2) {
                                                                                                                                                                  if (count($constraints) === 1) {
                                                                                                                                                                      $query->matching(reset($constraints));
                                                                                                                                                                  } elseif (count($constraints) >= 2) {
                                                                                                                                                                      if (count($constraints) === 1) {
                                                                                                                                                                          $query->matching(reset($constraints));
                                                                                                                                                                      } elseif (count($constraints) >= 2) {
                                                                                                                                                                          if (count($constraints) === 1) {
                                                                                                                                                                              $query->matching(reset($constraints));
                                                                                                                                                                          } elseif (count($constraints) >= 2) {
                                                                                                                                                                              if (count($constraints) === 1) {
                                                                                                                                                                                  $query->matching(reset($constraints));
                                                                                                                                                                              } elseif (count($constraints) >= 2) {
                                                                                                                                                                                  if (count($constraints) === 1) {
                                                                                                                                                                                      $query->matching(reset($constraints));
                                                                                                                                                                                  } elseif (count($constraints) >= 2) {
                                                                                                                                                                                      $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                                                                  }
                                                                                                                                                                                  $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                                                              }
                                                                                                                                                                              $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                                                          }
                                                                                                                                                                          $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                                                      }
                                                                                                                                                                      $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                                                  }
                                                                                                                                                                  $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                                              }
                                                                                                                                                              $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                                          }
                                                                                                                                                          $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                                      }
                                                                                                                                                      $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                                  }
                                                                                                                                                  $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                              }
                                                                                                                                              $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                          }
                                                                                                                                          $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                      }
                                                                                                                                      $query->matching($query->logicalAnd(...$constraints));
                                                                                                                                  }
                                                                                                                                  $query->matching($query->logicalAnd(...$constraints));
                                                                                                                              }
                                                                                                                              $query->matching($query->logicalAnd(...$constraints));
                                                                                                                          }
                                                                                                                          $query->matching($query->logicalAnd(...$constraints));
                                                                                                                      }
                                                                                                                      $query->matching($query->logicalAnd(...$constraints));
                                                                                                                  }
                                                                                                                  $query->matching($query->logicalAnd(...$constraints));
                                                                                                              }
                                                                                                              $query->matching($query->logicalAnd(...$constraints));
                                                                                                          }
                                                                                                          $query->matching($query->logicalAnd(...$constraints));
                                                                                                      }
                                                                                                      $query->matching($query->logicalAnd(...$constraints));
                                                                                                  }
                                                                                                  $query->matching($query->logicalAnd(...$constraints));
                                                                                              }
                                                                                              $query->matching($query->logicalAnd(...$constraints));
                                                                                          }
                                                                                          $query->matching($query->logicalAnd(...$constraints));
                                                                                      }
                                                                                      $query->matching($query->logicalAnd(...$constraints));
                                                                                  }
                                                                                  $query->matching($query->logicalAnd(...$constraints));
                                                                              }
                                                                              $query->matching($query->logicalAnd(...$constraints));
                                                                          }
                                                                          $query->matching($query->logicalAnd(...$constraints));
                                                                      }
                                                                      $query->matching($query->logicalAnd(...$constraints));
                                                                  }
                                                                  $query->matching($query->logicalAnd(...$constraints));
                                                              }
                                                              $query->matching($query->logicalAnd(...$constraints));
                                                          }
                                                          $query->matching($query->logicalAnd(...$constraints));
                                                      }
                                                      $query->matching($query->logicalAnd(...$constraints));
                                                  }
                                                  $query->matching($query->logicalAnd(...$constraints));
                                              }
                                              $query->matching($query->logicalAnd(...$constraints));
                                          }
                                          $query->matching($query->logicalAnd(...$constraints));
                                      }
                                      $query->matching($query->logicalAnd(...$constraints));
                                  }
                                  $query->matching($query->logicalAnd(...$constraints));
                              }
                              $query->matching($query->logicalAnd(...$constraints));
                          }
                          $query->matching($query->logicalAnd(...$constraints));
                      }
                      $query->matching($query->logicalAnd(...$constraints));
                  }
                  $query->matching($query->logicalAnd(...$constraints));
              }
              $query->matching($query->logicalAnd(...$constraints));
          }
          $query->matching($query->logicalAnd(...$constraints));
      }
      $query->matching($query->logicalAnd(...$constraints));
  }
		
		// ORDER BY
		$query->setOrderings(['starttime' => QueryInterface::ORDER_DESCENDING, 'name' => QueryInterface::ORDER_ASCENDING]);		
		
		// we execute query
// 		debug($constraints);
// 		DebugUtility::debugQuery($query);
		return $query->execute();
	}
}
