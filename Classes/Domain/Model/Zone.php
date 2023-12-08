<?php

declare(strict_types=1);

namespace Slavlee\Advertising\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use Slavlee\Advertising\Service\Banner\BannerDeliveryService;
use Slavlee\Advertising\Utility\ZoneUtility;
use Slavlee\Advertising\Utility\GeneralUtility;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * Zone
 */
class Zone extends AbstractEntity
{

    /**
     * banners
     *
     * @var ObjectStorage<Banner>
     */
    #[Lazy]
    protected $banners = null;

    /**
     * name
     *
     * @var string
     */
    #[Validate(['validator' => 'NotEmpty'])]
    protected $name = '';

    /**
     * height
     *
     * @var string
     */
    #[Validate(['validator' => 'NotEmpty'])]
    protected $height = '';

    /**
     * width
     *
     * @var string
     */
    #[Validate(['validator' => 'NotEmpty'])]
    protected $width = '';

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
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
     * Returns the height
     *
     * @return string $height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets the height
     *
     * @param string $height
     * @return void
     */
    public function setHeight(string $height)
    {
        $this->height = $height;
    }

    /**
     * Returns the width
     *
     * @return string $width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets the width
     *
     * @param string $width
     * @return void
     */
    public function setWidth(string $width)
    {
        $this->width = $width;
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
     * Get the banner to display next request
     * based on prior
     *
     * @return Banner
     */
    public function getNextBanner()
    {
    	$service = GeneralUtility::makeInstance(BannerDeliveryService::class);
    	$banners = $service->getBannersFromActiveCampaignsForZone($this); // we want only banners from active campaigns
        
    	return $banners ? ZoneUtility::getNextBanner($banners) : null;
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
}
