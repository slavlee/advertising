<?php

declare(strict_types=1);

return [
    'tools_advertising_dashboard' => [
        'parent' => 'tools',
        'position' => 'bottom',
        'access' => 'admin',
        'workspaces' => 'live',
        'path' => '/module/advertising',
        'labels' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_mod.xlf',
        'iconIdentifier' => 'apps-pagetree-folder-contains-advertising',
        'extensionName' => 'Advertising',
        'controllerActions' => [
            \Slavlee\Advertising\Controller\Backend\DashboardController::class => ['show','campaign','recalculateCampaignStatistic']
        ],
        'inheritNavigationComponentFromMainModule' => false
    ]
];