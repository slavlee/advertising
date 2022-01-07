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
 * BannerStatistic
 */
class BannerStatistic extends BaseEntity
{

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
     * delivered
     *
     * @var string
     */
    protected $delivered = '';

    /**
     * beenVisible
     *
     * @var int
     */
    protected $beenVisible = 0;

    /**
     * clicked
     *
     * @var int
     */
    protected $clicked = 0;

    /**
     * banner
     *
     * @var \Slavlee\Advertisement\Domain\Model\Banner
     */
    protected $banner = null;

    /**
     * Returns the delivered
     *
     * @return string $delivered
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * Sets the delivered
     *
     * @param string $delivered
     * @return void
     */
    public function setDelivered(string $delivered)
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
}
