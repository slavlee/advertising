<?php
defined('TYPO3') || die();

(static function() {
	/***************************************************************
	 * NEW MODELS - START
	 **************************************************************/
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_advertisement_domain_model_campaign', 'EXT:advertisement/Resources/Private/Language/locallang_csh_tx_advertisement_domain_model_campaign.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_advertisement_domain_model_campaign');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_advertisement_domain_model_customer', 'EXT:advertisement/Resources/Private/Language/locallang_csh_tx_advertisement_domain_model_customer.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_advertisement_domain_model_customer');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_advertisement_domain_model_zone', 'EXT:advertisement/Resources/Private/Language/locallang_csh_tx_advertisement_domain_model_zone.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_advertisement_domain_model_zone');
    
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_advertisement_domain_model_bannerstatistic', 'EXT:advertisement/Resources/Private/Language/locallang_csh_tx_advertisement_domain_model_bannerstatistic.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_advertisement_domain_model_bannerstatistic');
    
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_advertisement_domain_model_campaignstatistic', 'EXT:advertisement/Resources/Private/Language/locallang_csh_tx_advertisement_domain_model_campaignstatistic.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_advertisement_domain_model_campaignstatistic');
    /***************************************************************
     * NEW MODELS - END
     **************************************************************/
    
    /***************************************************************
     * BACKEND MODULES - START
     **************************************************************/
    // Module System > Backend Users
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
   		'Advertisement',
   		'tools',
   		'Dashboard',
   		'bottom',
  		[
			\Slavlee\Advertisement\Controller\Backend\DashboardController::class => 'show,campaign',
   		],
  		[
			'access' => 'admin',
			'iconIdentifier' => 'apps-pagetree-folder-contains-advertisement',
			'labels' => 'LLL:EXT:advertisement/Resources/Private/Language/locallang_mod.xlf',
			'inheritNavigationComponentFromMainModule' => false,
   		]
	);       
    /***************************************************************
     * BACKEND MODULES - END
     **************************************************************/
})();
