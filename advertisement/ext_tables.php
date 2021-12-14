<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_advertisement_domain_model_campaign', 'EXT:advertisement/Resources/Private/Language/locallang_csh_tx_advertisement_domain_model_campaign.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_advertisement_domain_model_campaign');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_advertisement_domain_model_customer', 'EXT:advertisement/Resources/Private/Language/locallang_csh_tx_advertisement_domain_model_customer.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_advertisement_domain_model_customer');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_advertisement_domain_model_zone', 'EXT:advertisement/Resources/Private/Language/locallang_csh_tx_advertisement_domain_model_zone.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_advertisement_domain_model_zone');
})();
