<?php
defined('TYPO3') || die();

// Add new page plugin
$GLOBALS['TCA']['pages']['columns']['module']['config']['items'][] = [
	0 => 'LLL:EXT:advertising/Resources/Private/Language/locallang_be.xlf:ad-folder',
	1 => 'advertising',
	2 => 'apps-pagetree-folder-contains-advertising'
];
$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['contains-advertising'] = 'apps-pagetree-folder-contains-advertising';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
	'advertising',
	'Configuration/TSconfig/Page/AdOnly.tsconfig',
	'EXT:advertising :: Restrict pages to advertising records'
);