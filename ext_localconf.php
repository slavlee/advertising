<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Advertising',
        'Zone',
        [
            \Slavlee\Advertising\Controller\ZoneController::class => 'show'
        ],
        // non-cacheable actions
        [
            \Slavlee\Advertising\Controller\ZoneController::class => 'show'
        ]
    );
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    	'Advertising',
    	'Clicktracking',
    	[
    		\Slavlee\Advertising\Controller\TrackingController::class => 'click,delivered'
    	],
    	// non-cacheable actions
    	[
    		\Slavlee\Advertising\Controller\TrackingController::class => 'click,delivered'
    	]
	);
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
   		'Advertising',
   		'Deliveredtracking',
   		[
   			\Slavlee\Advertising\Controller\TrackingController::class => 'delivered'
   		],
   		// non-cacheable actions
   		[
   			\Slavlee\Advertising\Controller\TrackingController::class => 'delivered'
   		]
   	);
    
    // Mod List View
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    	"@import 'EXT:advertising/Configuration/TSconfig/Page/Mod/Web/List.tsconfig'"
	);

    // wizards    
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    	"@import 'EXT:advertising/Configuration/TSconfig/Page/Mod/Wizards/Groups.tsconfig'
    	 @import 'EXT:advertising/Configuration/TSconfig/Page/Mod/Wizards/Plugins.tsconfig'
		 @import 'EXT:advertising/Configuration/TSconfig/Page/Mod/Wizards/Banner.tsconfig'"
	);
    
    //Caches
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['advertising_campaign_totalstatistic'] ??= [];
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['advertising_campaign_totalstatistic']['backend'] ??= \TYPO3\CMS\Core\Cache\Backend\SimpleFileBackend::class;
})();
