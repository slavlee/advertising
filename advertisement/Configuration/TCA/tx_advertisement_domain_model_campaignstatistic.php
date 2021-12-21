<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_campaignstatistic',
        'label' => 'priority',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'banner_persisted,campaign_persisted',
        'iconfile' => 'EXT:advertisement/Resources/Public/Icons/tx_advertisement_domain_model_campaignstatistic.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'priority, delivered, been_visible, clicked, banner_persisted, campaign_persisted, campaign, banner, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'],
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
                'foreign_table' => 'tx_advertisement_domain_model_campaignstatistic',
                'foreign_table_where' => 'AND {#tx_advertisement_domain_model_campaignstatistic}.{#pid}=###CURRENT_PID### AND {#tx_advertisement_domain_model_campaignstatistic}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'priority' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_campaignstatistic.priority',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'delivered' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_campaignstatistic.delivered',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'been_visible' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_campaignstatistic.been_visible',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'clicked' => [
            'exclude' => true,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_campaignstatistic.clicked',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'banner_persisted' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_campaignstatistic.banner_persisted',
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
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_campaignstatistic.campaign_persisted',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'campaign' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_campaignstatistic.campaign',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_advertisement_domain_model_campaign',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
        'banner' => [
            'exclude' => false,
            'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_campaignstatistic.banner',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tt_content',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
    
    ],
];
