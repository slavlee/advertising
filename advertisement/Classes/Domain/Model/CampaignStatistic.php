<?php

declare(strict_types=1);

namespace Slavlee\Advertisement\Domain\Model;


use Slavlee\Advertisement\Statistic\GeneralStatistic;

/**
 * This file is part of the "Advertisement" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */

/**
 * CampaignStatistic
 */
class CampaignStatistic extends BaseEntity
{

    /**
     * priority
     *
     * @var int
     */
    protected $priority = 0;

    /**
     * Amount of times the banner was delivered into the displayed HTML document.
     *
     * @var int
     */
    protected $delivered = 0;

    /**
     * Amount of times the banner was inside the visible viewport of the users.
     *
     * @var int
     */
    protected $beenVisible = 0;

    /**
     * Amount of times user clicked on the banner
     *
     * @var int
     */
    protected $clicked = 0;

    /**
     * The last HTML representation of the delivered banner
     *
     * @var string
     */
    protected $bannerPersisted = '';

    /**
     * campaignPersisted
     *
     * @var string
     */
    protected $campaignPersisted = '';

    /**
     * crdate
     *
     * @var \DateTime
     */
    protected $crdate = null;

    /**
     * campaign
     *
     * @var \Slavlee\Advertisement\Domain\Model\Campaign
     */
    protected $campaign = null;

    /**
     * banner
     *
     * @var \Slavlee\Advertisement\Domain\Model\Banner
     */
    protected $banner = null;

    /**
     * Returns the priority
     *
     * @return int $priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Sets the priority
     *
     * @param int $priority
     * @return void
     */
    public function setPriority(int $priority)
    {
        $this->priority = $priority;
    }

    /**
     * Returns the delivered
     *
     * @return int $delivered
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * Sets the delivered
     *
     * @param int $delivered
     * @return void
     */
    public function setDelivered(int $delivered)
    {
        $this->delivered = $delivered;
    }

    /**
     * Banner has beend delivered so increment delivered property
     *
     * @return void
     */
    public function incrementDelivered()
    {
        $this->delivered++;
    }

    /**
     * Returns the beenVisible
     *
     * @return int $beenVisible
     */
    public function getBeenVisible()
    {
        return $this->beenVisible;
    }

    /**
     * Sets the beenVisible
     *
     * @param int $beenVisible
     * @return void
     */
    public function setBeenVisible(int $beenVisible)
    {
        $this->beenVisible = $beenVisible;
    }

    /**
     * Returns the clicked
     *
     * @return int $clicked
     */
    public function getClicked()
    {
        return $this->clicked;
    }

    /**
     * Sets the clicked
     *
     * @param int $clicked
     * @return void
     */
    public function setClicked(int $clicked)
    {
        $this->clicked = $clicked;
    }

    /**
     * Banner has been clicked so increment clicked property
     *
     * @return void
     */
    public function incrementClicked()
    {
        $this->clicked++;
    }

    /**
     * Returns the bannerPersisted
     *
     * @return string $bannerPersisted
     */
    public function getBannerPersisted()
    {
        return $this->bannerPersisted;
    }

    /**
     * Sets the bannerPersisted
     *
     * @param string $bannerPersisted
     * @return void
     */
    public function setBannerPersisted(string $bannerPersisted)
    {
        $this->bannerPersisted = $bannerPersisted;
    }

    /**
     * Returns the campaign
     *
     * @return \Slavlee\Advertisement\Domain\Model\Campaign $campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Sets the campaign
     *
     * @param \Slavlee\Advertisement\Domain\Model\Campaign $campaign
     * @return void
     */
    public function setCampaign(\Slavlee\Advertisement\Domain\Model\Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Returns the banner
     *
     * @return \Slavlee\Advertisement\Domain\Model\Banner $banner
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Sets the banner
     *
     * @param \Slavlee\Advertisement\Domain\Model\Banner $banner
     * @return void
     */
    public function setBanner(\Slavlee\Advertisement\Domain\Model\Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Returns the campaignPersisted
     *
     * @return string $campaignPersisted
     */
    public function getCampaignPersisted()
    {
        return $this->campaignPersisted;
    }

    /**
     * Sets the campaignPersisted
     *
     * @param string $campaignPersisted
     * @return void
     */
    public function setCampaignPersisted(string $campaignPersisted)
    {
        $this->campaignPersisted = $campaignPersisted;
    }

    /**
     * Returns the crdate
     *
     * @return \DateTime $crdate
     */
    public function getCrdate()
    {
        return $this->crdate;
    }

    /**
     * Sets the crdate
     *
     * @param \DateTime $crdate
     * @return void
     */
    public function setCrdate(\DateTime $crdate)
    {
        $this->crdate = $crdate;
    }
    
    /**
     * Return the Click Through Value of the whole campaign
     * @return float
     */
    public function getCtr()
    {
    	return GeneralStatistic::ctr($this->getClicked(), $this->getDelivered());
    }
    
    /**
     * Only return the metrics data
     * @return array
     */
    public function getMetrics()
    {
    	return [
    		'uid' => $this->getUid(),
    		'beenVisible' => $this->getBeenVisible(),
    		'delivered' => $this->getDelivered(),
    		'clicked' => $this->getClicked(),
    		'ctr' => $this->getCtr()
    	];
    }
}
