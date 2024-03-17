<?php
defined('TYPO3') || die();

(static function() {
    $obj = new \Slavlee\Advertising\Bootstrap\ExtLocalconf();
	$obj->invoke();
})();
