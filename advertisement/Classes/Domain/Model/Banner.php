<?php

declare(strict_types=1);

namespace Slavlee\Advertisement\Domain\Model;


/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * Banner
 */
class Banner extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
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
     * $link
     * @var string
     */
    protected $link = '';

    /**
     * customer
     *
     * @var \Slavlee\Advertisement\Domain\Model\Customer
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $customer = null;

    /**
     * zones
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slavlee\Advertisement\Domain\Model\Zone>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $zones = null;

    /**
     * Returns the customer
     *
     * @return \Slavlee\Advertisement\Domain\Model\Customer $customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Sets the customer
     *
     * @param \Slavlee\Advertisement\Domain\Model\Customer $customer
     * @return void
     */
    public function setCustomer(\Slavlee\Advertisement\Domain\Model\Customer $customer)
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
        $this->zones = $this->zones ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Zone
     *
     * @param \Slavlee\Advertisement\Domain\Model\Zone $zone
     * @return void
     */
    public function addZone(\Slavlee\Advertisement\Domain\Model\Zone $zone)
    {
        $this->zones->attach($zones);
    }

    /**
     * Removes a Zone
     *
     * @param \Slavlee\Advertisement\Domain\Model\Zone $zoneToRemove The Zone to be removed
     * @return void
     */
    public function removeZone(\Slavlee\Advertisement\Domain\Model\Zone $zoneToRemove)
    {
        $this->zones->detach($zoneToRemove);
    }

    /**
     * Returns the zones
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slavlee\Advertisement\Domain\Model\Zone> zones
     */
    public function getZones()
    {
        return $this->zones;
    }

    /**
     * Sets the zones
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Slavlee\Advertisement\Domain\Model\Zone> $zones
     * @return void
     */
    public function setZones(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $zones)
    {
        $this->zones = $zones;
    }
    
    /**
     * Returns the link
     * @return string
     */
    public function getLink()
    {
    	return $this->link;
    }
    
    /**
     * Sets the link
     * @param string $link
     * @return void
     */
    public function setLink($link)
    {
    	$this->link = $link;
    }
}
