<?php

declare(strict_types=1);

namespace Slavlee\Advertisement\Domain\Model;


use Slavlee\Advertisement\Utility\GeneralUtility;
use Slavlee\Advertisement\Utility\CacheUtility;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * Campaign
 */
class Campaign extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $name = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * starttime
     *
     * @var \DateTime
     */
    protected $starttime = null;

    /**
     * endtime
     *
     * @var \DateTime
     */
    protected $endtime = null;

    /**
     * banners
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slavlee\Advertisement\Domain\Model\Banner>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $banners = null;
    
    /**
     * $totalStatistic, holds a summary of all CampaignStatistic for given Campaign
     * @var \stdClass
     */
    protected $totalStatistic = null;

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->banners = $this->banners ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Banner
     *
     * @param \Slavlee\Advertisement\Domain\Model\Banner $banner
     * @return void
     */
    public function addBanner(\Slavlee\Advertisement\Domain\Model\Banner $banner)
    {
        $this->banners->attach($banner);
    }

    /**
     * Removes a Banner
     *
     * @param \Slavlee\Advertisement\Domain\Model\Banner $bannerToRemove The Banner to be removed
     * @return void
     */
    public function removeBanner(\Slavlee\Advertisement\Domain\Model\Banner $bannerToRemove)
    {
        $this->banners->detach($bannerToRemove);
    }

    /**
     * Returns the banners
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slavlee\Advertisement\Domain\Model\Banner> $banners
     */
    public function getBanners()
    {
        return $this->banners;
    }

    /**
     * Sets the banners
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slavlee\Advertisement\Domain\Model\Banner> $banners
     * @return void
     */
    public function setBanners(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $banners)
    {
        $this->banners = $banners;
    }

    /**
     * Returns the starttime
     *
     * @return \DateTime $starttime
     */
    public function getStartTime()
    {
        return $this->starttime;
    }

    /**
     * Sets the starttime
     *
     * @param \DateTime $starttime
     * @return void
     */
    public function setStartTime(\DateTime $starttime)
    {
        $this->starttime = $starttime;
    }

    /**
     * Returns the endtime
     *
     * @return \DateTime $endtime
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * Sets the endtime
     *
     * @param \DateTime $endtime
     * @return void
     */
    public function setEndtime(\DateTime $endtime)
    {
        $this->endtime = $endtime;
    }
    
    /**
     * Returns a summary of all related CampaignStatistic, if exists
     * @return \Slavlee\Advertisement\Domain\Model\CampaignStatistic
     */
    public function getTotalStatistic()
    {
    	// If not set, then fetch statistic
    	if ($this->totalStatistic == null)
    	{
    		// Try to load from cache
    		$session = $GLOBALS['BE_USER']->getSession();
    		$cacheIdentifier = CacheUtility::formatIdentifier(__CLASS__ . '.' . __FUNCTION__);
    		$unserializedCacheValue = $session->get($cacheIdentifier);
    		
    		// Check if there is a valid cache value
    		if (!$unserializedCacheValue) 
    		{
    			// If cache value is invalid, then load fresh
    			$this->totalStatistic = $this->getTotalStatisticFresh();
    			
    			// and save to cache
    			$session->set($cacheIdentifier, serialize($this->totalStatistic));
    		}else 
    		{
    			// if so, then unserialize it
    			$cacheValue = unserialize($unserializedCacheValue);
    			
    			if (!empty($cacheValue))
    			{
    				$this->totalStatistic = $cacheValue;
    				 
    				// check if data is older than 5mins
    				$now = new \DateTime();

    				if (!$this->totalStatistic->crdate || ($now->getTimestamp() - $this->totalStatistic->crdate->getTimestamp()) >= 300000)
    				{
    					// then refetch data
    					$this->totalStatistic = $this->getTotalStatisticFresh();
    						
    					// and save to cache
    					$session->set($cacheIdentifier, serialize($this->totalStatistic));
    			
    					debug('refetched');
    				}
    			}else
    			{
    				// If nothing in cache, then load from db
    				$this->totalStatistic = $this->getTotalStatisticFresh();
    				 
    				// and save to cache
    				$session->set($cacheIdentifier, serialize($this->totalStatistic));
    			}	
    		}   
    	}
    	
    	return $this->totalStatistic;
    }
    
    /**
     * Return total campaign statistic
     * @return \stdClass
     */
    protected function getTotalStatisticFresh()
    {
    	$totalStatistic = null;
    	
    	/**
    	 * @var \Slavlee\Advertisement\Service\Campaign\StatisticService $service
    	 */
    	$service = GeneralUtility::makeInstance(\Slavlee\Advertisement\Service\Campaign\StatisticService::class);
    	 
    	if ($service->execute('findTotalCampaignStatistics', $this))
    	{
    		$totalStatistic = $service->getLastReturnValue();
    		$totalStatistic->crdate = new \DateTime();
    	}
    	
    	return $totalStatistic;
    }
}
