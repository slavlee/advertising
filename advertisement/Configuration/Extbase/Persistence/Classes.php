<?php
declare(strict_types = 1);

return [
    \Slavlee\Advertisement\Domain\Model\Banner::class => [
        'tableName' => 'tt_content',
        'recordType' => 'Tx_Advertisement_Banner',
    	'properties' => [
    		'link' => [
    			'fieldName' => 'header_link'
    		]
    	]
    ],
];
