<?php
/**
 * Definitions for routes provided by EXT:backend
 * Contains all "regular" routes for entry points
 *
 * Please note that this setup is preliminary until all Core use-cases are set up here.
 * Especially some more properties regarding modules will be added until TYPO3 CMS 7 LTS, and might change.
 *
 * Currently the "access" property is only used so no token creation + validation is made,
 * but will be extended further.
 */
return [
    // Login screen of the TYPO3 Backend
    'advertisement_campaign_show' => [
        'path' => '/advertisement/campaign/',
    	'referrer' => 'required,refresh-empty',
        'target' => \Slavlee\Advertisement\Controller\Backend\CampaignController::class . '::showAction'
    ]
];