<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_campaignstatistic',
        'label' => 'priority',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
        ],
        'searchFields' => 'banner_persisted,campaign_persisted',
        'iconfile' => 'EXT:advertising/Resources/Public/Icons/tx_advertising_domain_model_campaignstatistic.svg',
    	'previewRenderer' => \Slavlee\Advertising\Backend\PreviewRenderer\NonRenderer::class
    ],
    'types' => [
        '1' => ['showitem' => 'priority, delivered, been_visible, clicked, banner_persisted, campaign_persisted, crdate, campaign, banner, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource, '],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_advertising_domain_model_campaignstatistic',
                'foreign_table_where' => 'AND {#tx_advertising_domain_model_campaignstatistic}.{#pid}=###CURRENT_PID### AND {#tx_advertising_domain_model_campaignstatistic}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        'priority' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_campaignstatistic.priority',
            'config' => [
                'type' => 'number',
                'size' => 5,
                'eval' => 'trim',
                'default' => 0,
            	'range' => [
            		'lower' => 0,
            		'upper' => 10
            	],
            	'slider' => [
            		'step' => 1,
            		'width' => 100
            	]
            ]
        ],
        'delivered' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_campaignstatistic.delivered',
            'config' => [
                'type' => 'number',
                'size' => 4,
                'default' => 0
            ]
        ],
        'been_visible' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_campaignstatistic.been_visible',
            'config' => [
                'type' => 'number',
                'size' => 4,
                'default' => 0
            ]
        ],
        'clicked' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_campaignstatistic.clicked',
            'config' => [
                'type' => 'number',
                'size' => 4,
                'default' => 0
            ]
        ],
        'banner_persisted' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_campaignstatistic.banner_persisted',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'campaign_persisted' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_campaignstatistic.campaign_persisted',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'crdate' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_campaignstatistic.crdate',
            'config' => [
                'type' => 'datetime',
                'size' => 10
            ],
        ],
        'campaign' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_campaignstatistic.campaign',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_advertising_domain_model_campaign',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
        'banner' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_campaignstatistic.banner',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tt_content',
            	'foreign_table_where' => 'CType = "advertising_banner"',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
    
    ],
];
