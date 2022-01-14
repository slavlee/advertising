<?php
defined('TYPO3') || die();

/**********************************************************************
 * REGISTER PLUGINS - START
 *********************************************************************/
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Advertising',
    'Zone',
    'Zone'
);

/**********************************************************************
 * REGISTER PLUGINS - END
 *********************************************************************/
    
/**********************************************************************
 * CUSTOM CTYPES - START
 *********************************************************************/
// Adds the content element to the "Type" dropdown
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
	'tt_content',
	'CType',
	[
		// title
		'LLL:EXT:advertising/Resources/Private/Language/locallang_be.xlf:tx_advertising_banner.name',
		// plugin signature: extkey_identifier
		'advertising_banner',
		// icon identifier
		'ad-banner',
	],
	'textmedia',
	'after'
);    

/* Add customer and zones fields - START */
$newColumns = [
	'customer' => [
		'exclude' => false,
		'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_banner.customer',
		'config' => [
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'tx_advertising_domain_model_customer',
			'orderBy' => ' ORDER BY name ASC',
			'minitems' => 1,
			'maxitems' => 1,
			'size' => 1,
			'default' => 0
		]	
	],
	'zones' => [
		'exclude' => false,
		'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_banner.zones',
		'config' => [
			'type' => 'group',
			'allowed' => 'tx_advertising_domain_model_zone',
			'foreign_table' => 'tx_advertising_domain_model_zone',
			'MM' => 'tx_advertising_zone_banner_mm',
			'MM_opposite_field' => 'banners',
			'orderBy' => ' ORDER BY name ASC',
			'minitems' => 0,
			'maxitems' => 99,
			'size' => 5,
			'default' => 0
		]
	],
	'campaigns' => [
		'exclude' => false,
		'label' => 'LLL:EXT:advertising/Resources/Private/Language/locallang_db.xlf:tx_advertising_domain_model_campaign',
		'config' => [
			'type' => 'group',
			'allowed' => 'tx_advertising_domain_model_campaign',
			'foreign_table' => 'tx_advertising_domain_model_campaign',
			'MM' => 'tx_advertising_campaign_banner_mm',
			'MM_opposite_field' => 'banners',
			'multiple' => false,				
			'orderBy' => ' ORDER BY name ASC',
			'minitems' => 1,
			'maxitems' => 99,
			'size' => 5,
			'default' => 0
		]
	]
];

$GLOBALS['TCA']['tt_content']['columns'] = array_merge($GLOBALS['TCA']['tt_content']['columns'], $newColumns);
/* Add customer and zones fields - END */

/* Set Fields for Banner - START */
$GLOBALS['TCA']['tt_content']['types']['advertising_banner'] = [
	'showitem' => 'CType, header, image, header_link, customer, zones, campaigns, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, --palette--;;hidden',
	'columnsOverrides' => [		
		'image' => [
			'config' => [
				'minitems' => 1,
				'maxitems' => 1,
			]
		],
		'header_link' => [
			'config' => [
				'eval' => 'required'
			]
		]
	]
];
/* Set Fields for Banner - END */

/* Add Icon for banner - START */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['advertising_banner'] = 'advertising-plugin-banner';
/* Add Icon for banner - END */
/**********************************************************************
 * CUSTOM CTYPES - END
 *********************************************************************/

/**********************************************************************
 * FLEXFORMS - START
 *********************************************************************/
// plugin signature: <extension key without underscores> '_' <plugin name in lowercase>
$pluginSignature = 'advertising_zone';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
	$pluginSignature,
	// Flexform configuration schema file
	'FILE:EXT:advertising/Configuration/FlexForms/Zone.xml'
);

/* Remove unnecesary fields - START */
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
/* Remove unnecesary fields - END */
/**********************************************************************
 * FLEXFORMS - END
 *********************************************************************/
