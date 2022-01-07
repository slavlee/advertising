<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_bannerstatistic',
        'label' => 'delivered',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
        ],
        'searchFields' => 'delivered',
        'iconfile' => 'EXT:advertisement/Resources/Public/Icons/tx_advertisement_domain_model_bannerstatistic.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'delivered, been_visible, clicked, banner, campaign, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource, '],
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
                    ['', 0],
                ],
                'foreign_table' => 'tx_advertisement_domain_model_bannerstatistic',
                'foreign_table_where' => 'AND {#tx_advertisement_domain_model_bannerstatistic}.{#pid}=###CURRENT_PID### AND {#tx_advertisement_domain_model_bannerstatistic}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        'delivered' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_bannerstatistic.delivered',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'been_visible' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_bannerstatistic.been_visible',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'clicked' => [
            'exclude' => true,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_bannerstatistic.clicked',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'banner' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_bannerstatistic.banner',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tt_content',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
        'campaign' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_bannerstatistic.campaign',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_advertisement_domain_model_campaign',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
    
    ],
];
