<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Bootstrap;

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Slavlee\Advertising\Controller\ZoneController;
use Slavlee\Advertising\Controller\TrackingController;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */


class ExtLocalconf extends Base
{
/**
     * Does the main class purpose
     * @return void
     */
    public function invoke(): void
    {
        $this->configurePlugins();
        $this->registerCaches();
    }

    /**
     * Configure all Frontend Plugins
     * @return void
     */
    private function configurePlugins(): void
    {
        ExtensionUtility::configurePlugin(
            'Advertising',
            'Zone',
            [
                ZoneController::class => 'show'
            ],
            // non-cacheable actions
            [
                ZoneController::class => 'show'
            ]
        );
        
        ExtensionUtility::configurePlugin(
            'Advertising',
            'Clicktracking',
            [
                TrackingController::class => 'click,delivered'
            ],
            // non-cacheable actions
            [
                TrackingController::class => 'click,delivered'
            ]
        );
        
        ExtensionUtility::configurePlugin(
               'Advertising',
               'Deliveredtracking',
               [
                   TrackingController::class => 'delivered'
               ],
               // non-cacheable actions
               [
                   TrackingController::class => 'delivered'
               ]
           );
    }

    /**
     * Register all caches
     * @return void
     */
    private function registerCaches(): void
    {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['advertising_campaign_totalstatistic'] ??= [];
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['advertising_campaign_totalstatistic']['backend'] ??= \TYPO3\CMS\Core\Cache\Backend\SimpleFileBackend::class;
    }
}