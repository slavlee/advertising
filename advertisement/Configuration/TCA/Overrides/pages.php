<?php
defined('TYPO3') || die();

// Add new page plugin
$GLOBALS['TCA']['pages']['columns']['module']['config']['items'][] = [
	0 => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_be.xlf:ad-folder',
	1 => 'advertisement',
	2 => 'apps-pagetree-folder-contains-advertisement'
];
$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['contains-advertisement'] = 'apps-pagetree-folder-contains-advertisement';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
	'advertisement',
	'Configuration/TSconfig/Page/AdOnly.tsconfig',
	'EXT:advertisement :: Restrict pages to advertisement records'
);