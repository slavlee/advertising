<?php

declare(strict_types=1);

namespace Slavlee\Advertising\Domain\Model;


use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use Slavlee\Advertising\Service\Campaign\StatisticService;
use Slavlee\Advertising\Utility\GeneralUtility;
use Slavlee\Advertising\Utility\CacheUtility;
use Slavlee\Advertising\Utility\CampaignUtility;
use Slavlee\Advertising\Utility\DateUtility;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * Campaign
 */
class Campaign extends AbstractEntity
{

    /**
     * name
     *
     * @var string
     */
    #[Validate(['validator' => 'NotEmpty'])]
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
     * @var ObjectStorage<Banner>
     */
    #[Lazy]
    protected $banners = null;
    
    /**
     * $totalStatistic, holds a summary of all CampaignStatistic for given Campaign
     * @var \stdClass
     */
    protected $totalStatistic = null;
    
    /**
     * $hidden
     * @var boolean
     */
    protected $disabled = false;

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
        $this->banners = $this->banners ?: new ObjectStorage();
    }

    /**
     * Adds a Banner
     *
     * @param Banner $banner
     * @return void
     */
    public function addBanner(Banner $banner)
    {
        $this->banners->attach($banner);
    }

    /**
     * Removes a Banner
     *
     * @param Banner $bannerToRemove The Banner to be removed
     * @return void
     */
    public function removeBanner(Banner $bannerToRemove)
    {
        $this->banners->detach($bannerToRemove);
    }

    /**
     * Returns the banners
     *
     * @return ObjectStorage<Banner> $banners
     */
    public function getBanners()
    {
        return $this->banners;
    }
    
    /**
     * Returns only active banners
     *
     * @return ObjectStorage<Banner> $banners
     */
    public function getActiveBanners()
    {
    	// Banners don't have start-/endtime yet
    	return $this->getBanners();
    	
//     	$activeBanners = [];
    	
//     	foreach($this->banners as $banner)
//     	{
//     		if ($banner->isActive())
//     		{
//     			$activeBanners[] = $banner;
//     		}
//     	}
    	
//     	return $activeBanners;
    }

    /**
     * Sets the banners
     *
     * @param ObjectStorage<Banner> $banners
     * @return void
     */
    public function setBanners(ObjectStorage $banners)
    {
        $this->banners = $banners;
    }

    /**
     * Returns the starttime
     *
     * @return \DateTime $starttime
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * Sets the starttime
     *
     * @param \DateTime $starttime
     * @return void
     */
    public function setStarttime(\DateTime $starttime)
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
     * Returns the disabled
     * @return boolean
     */
    public function getDisabled()
    {
    	return $this->disabled;
    }
    
	/**
     * Sets the $disabled
     * @param boolean $disabled
     * @return void
     */
    public function setDisabled($disabled)
    {
    	$this->disabled = boolval($disabled);
    }
    
    /**
     * Returns the css class reflecting current state
     * @return string
     */
    public function getStateCssClass()
    {
    	if ($this->isActive())
    	{
    		return 'active';
    	}else if($this->getDisabled())
    	{
    		return 'disabled';
    	}else if($this->isExpired())
    	{
    		return 'expired';
    	}
    }
    
    /**
     * Returns a summary of all related CampaignStatistic, if exists
     * @return CampaignStatistic
     */
    public function getTotalStatistic()
    {
    	return $this->getTotalStatisticFresh();
    	
    	// If not set, then fetch statistic
    	if ($this->totalStatistic == null)
    	{
    		// Try to load from cache
    		$session = $GLOBALS['BE_USER']->getSession();
    		$cacheIdentifier = CacheUtility::formatIdentifier(__CLASS__ . '_' . __FUNCTION__ . '_' . $this->getUid());
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
    				$diffInMinutes = 0;
    				
    				if ($this->totalStatistic && $this->totalStatistic->crdate)
    				{
	    				$diffInMinutes = DateUtility::diffTotalMinutes($now, $this->totalStatistic->crdate);	    				
    				}
    				
    				if (!$this->totalStatistic || !$this->totalStatistic->crdate || $diffInMinutes >= 5)
    				{
    					// then refetch data
    					$this->totalStatistic = $this->getTotalStatisticFresh();
    					
    					// and save to cache
    					$session->set($cacheIdentifier, serialize($this->totalStatistic));
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
     * Return TRUE if campaign is active
     * @return boolean
     */
    public function isActive()
    {
    	$now = new \DateTime();
    	$startTime = $this->getStarttime();
    	$endTime = $this->getEndtime();
    	
    	return !$this->getDisabled() && ($startTime == null || $startTime->getTimestamp() <= $now->getTimestamp()) && ($endTime == null || $endTime->getTimestamp() >= $now->getTimestamp()); 
    }
    
    /**
     * Return TRUE if campaign is expired
     * @return boolean
     */
    public function isExpired()
    {
    	return CampaignUtility::isExpired($this);
    }
    
    /**
     * Return the language key for given state
     * @return string
     */
    public function getStateLangKey()
    {
    	$langKey = 'tx_advertising_domain_model_campaign.state.';
    	
    	if ($this->isActive())
    	{
    		$langKey .= 'active';
    	}elseif ($this->isExpired())
    	{
    		$langKey .= 'expired';
    	}elseif ($this->getDisabled())
    	{
    		$langKey .= 'disabled';
    	}
    	
    	return $langKey;
    }
    
    /**
     * Return total campaign statistic
     * @return \stdClass
     */
    protected function getTotalStatisticFresh()
    {
    	/**
    	 * @var \Slavlee\Advertising\Service\Campaign\StatisticService $service
    	 */
    	$service = GeneralUtility::makeInstance(StatisticService::class);
    	$service->execute('findTotalCampaignStatistics', $this);
    	$totalStatistic = $service->getLastReturnValue();
    	
    	if ($totalStatistic)
    	{
    		$totalStatistic->crdate = new \DateTime();
    	}
    	
    	return $totalStatistic;
    }
}
