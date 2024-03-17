<?php

declare(strict_types=1);

namespace Slavlee\Advertising\Domain\Model;


use Slavlee\Advertising\Statistic\GeneralStatistic;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Kevin Chileong Lee <support@slavlee.de>, Slavlee
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
     * @var Campaign
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
     * @var Banner
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
     * @return Banner $banner
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Sets the banner
     *
     * @param Banner $banner
     * @return void
     */
    public function setBanner(Banner $banner)
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
     * @return Campaign $campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Sets the campaign
     *
     * @param Campaign $campaign
     * @return void
     */
    public function setCampaign(Campaign $campaign)
    {
        $this->campaign = $campaign;
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
     * Return itself as stdClass
     * @return \stdClass
     */
    public function toStdClass()
    {
    	$std = new \stdClass();
    	$std->beenVisible = $this->getBeenVisible();
    	$std->clicked = $this->getClicked();
    	$std->delivered = $this->getDelivered();
    	$std->ctr = $this->getCtr();
    	$std->crdate = $this->getCrdate();
    	
    	return $std;
    }
}
