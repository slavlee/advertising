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
/**********************************************************************
 * CUSTOM CTYPES - END
 *********************************************************************/