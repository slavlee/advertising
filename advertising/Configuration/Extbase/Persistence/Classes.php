<?php
declare(strict_types = 1);

return [
    \Slavlee\Advertising\Domain\Model\Banner::class => [
        'tableName' => 'tt_content',
        'recordType' => 'advertising_banner',
    	'properties' => [
    		'link' => [
    			'fieldName' => 'header_link'
    		],
   			'name' => [
				'fieldName' => 'header'
   			],
    	    'type' => [
   			    'fieldName' => 'ad_type'
   			]
    	]
    ],
	\Slavlee\Advertising\Domain\Model\Campaign::class => [
		'properties' => [
			'disabled' => [
				'fieldName' => 'hidden'
			],
		]
	]
];
