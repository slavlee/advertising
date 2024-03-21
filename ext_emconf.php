<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Advertising',
    'description' => 'The best advertising extension for TYPO3 to monetarize you TYPO3 webpage.',
    'category' => 'plugin',
    'author' => 'Kevin Chileong Lee',
    'author_email' => 'support@slavlee.de',
    'state' => 'stable',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
           'Slavlee\\Advertising\\' => 'Classes'
        ]
    ],
];
