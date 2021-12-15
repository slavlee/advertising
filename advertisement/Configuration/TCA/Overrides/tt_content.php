<?php
defined('TYPO3') || die();

/**********************************************************************
 * REGISTER PLUGINS - START
 *********************************************************************/
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Advertisement',
    'Zone',
    'Zone'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Advertisement',
    'Banner',
    'Banner'
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
		'LLL:EXT:advertisement/Resources/Private/Language/locallang_be.xlf:tt_content.cType.banner',
		// plugin signature: extkey_identifier
		'advertisement_banner',
		// icon identifier
		'ad-banner',
	],
	'textmedia',
	'after'
);    

/* Add customer and zones fields - START */
$GLOBALS['TCA']['tt_content']['columns']['customer'] = [
	'exclude' => false,
	'label' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_db.xlf:tx_advertisement_domain_model_banner.customer',
	'config' => [
		'type' => 'group',
		'internal_type' => 'db',
		'allowed' => 'tx_advertisement_domain_model_customer',
		'orderBy' => ' ORDER BY name ASC',
		'minitems' => 1,
		'maxitems' => 1,
		'size' => 1,
		'default' => 0
	]
];
/* Add customer and zones fields - END */

/* Set Fields for Banner - START */
$GLOBALS['TCA']['tt_content']['types']['advertisement_banner'] = [		
	'showitem' => 'CType, header, image, header_link, customer',
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

/**********************************************************************
 * CUSTOM CTYPES - END
 *********************************************************************/