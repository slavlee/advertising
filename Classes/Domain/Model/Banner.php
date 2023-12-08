<?php

declare(strict_types=1);

namespace Slavlee\Advertising\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyObjectStorage;
/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */
/**
 * Banner
 */
class Banner extends AbstractEntity
{

    /**
     * $link
     *
     * @var string
     */
    protected $link = '';

    /**
     * campaigns
     *
     * @var ObjectStorage<Campaign>
     */
    #[Lazy]
    protected $campaigns = null;

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
     * customer
     *
     * @var Customer
     */
    protected $customer = null;

    /**
     * zones
     *
     * @var ObjectStorage<Zone>
     */
    #[Lazy]
    protected $zones = null;
    
    /**
     * type
     *
     * @var string
     */
    protected $type = '';

    /**
     * Returns the customer
     *
     * @return Customer $customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Sets the customer
     *
     * @param Customer $customer
     * @return void
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

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
        $this->zones = $this->zones ?: new ObjectStorage();
        $this->campaigns = $this->campaigns ?: new ObjectStorage();
    }

    /**
     * Adds a Zone
     *
     * @param Zone $zone
     * @return void
     */
    public function addZone(Zone $zone)
    {
        $this->zones->attach($zones);
    }

    /**
     * Removes a Zone
     *
     * @param Zone $zoneToRemove The Zone to be removed
     * @return void
     */
    public function removeZone(Zone $zoneToRemove)
    {
        $this->zones->detach($zoneToRemove);
    }

    /**
     * Returns the zones
     *
     * @return ObjectStorage<Zone> zones
     */
    public function getZones()
    {
        return $this->zones;
    }

    /**
     * Sets the zones
     *
     * @param ObjectStorage<Zone> $zones
     * @return void
     */
    public function setZones(ObjectStorage $zones)
    {
        $this->zones = $zones;
    }

    /**
     * Adds a Campaign
     *
     * @param Campaign $campaigns
     * @return void
     */
    public function addCampaign(Campaign $campaign)
    {
        $this->campaigns->attach($campaigns);
    }

    /**
     * Removes a Campaign
     *
     * @param Campaign $campaignToRemove The Zone to be removed
     * @return void
     */
    public function removeCampaign(Campaign $campaignToRemove)
    {
        $this->campaigns->detach($campaignToRemove);
    }

    /**
     * Returns the campaigns
     *
     * @return ObjectStorage<Campaign> campaigns
     */
    public function getCampaigns()
    {
        return $this->campaigns;
    }

    /**
     * Sets the campaigns
     *
     * @param ObjectStorage<Campaign> $campaigns
     * @return void
     */
    public function setCampaigns(ObjectStorage $campaigns)
    {
        $this->campaigns = $campaigns;
    }

    /**
     * Returns the link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets the link
     *
     * @param string $link
     * @return void
     */
    public function setLink($link)
    {
        $this->link = $link;
    }
    
    /**
     * Returns true, if banner has at least one active campaign
     * @param \Slavlee\Advertising\Domain\Model\Banner $banner
     * @return bool
     */
    public function hasActiveCampaign()
    {
    	$campaigns = $this->getCampaigns();
    	
    	if (get_class($campaigns) == LazyObjectStorage::class)
    	{
    		$campaigns = $campaigns->toArray();		
    	}
    	
    	foreach($campaigns as $campaign)
    	{
    		if ($campaign->isActive())
    		{
    			return true;
    		}
    	}
    
    	return false;
    }
    
    /**
     * Returns the type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Sets the type
     *
     * @param string $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
