<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Advertisement',
        'Zone',
        [
            \Slavlee\Advertisement\Controller\ZoneController::class => 'show'
        ],
        // non-cacheable actions
        [
            \Slavlee\Advertisement\Controller\ZoneController::class => 'show'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Advertisement',
        'Banner',
        [
            \Slavlee\Advertisement\Controller\BannerController::class => 'show'
        ],
        // non-cacheable actions
        [
            \Slavlee\Advertisement\Controller\BannerController::class => 'show'
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    zone {
                        iconIdentifier = advertisement-plugin-zone
                        title = LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_zone.name
                        description = LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_zone.description
                        tt_content_defValues {
                            CType = list
                            list_type = advertisement_zone
                        }
                    }
                    banner {
                        iconIdentifier = advertisement-plugin-banner
                        title = LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_banner.name
                        description = LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_banner.description
                        tt_content_defValues {
                            CType = list
                            list_type = advertisement_banner
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
