<?php

require_once(__DIR__ . '/../vendor/autoload.php');

$collection = [
    [
        'anyTypeSort' => '3',
        'matchQuality' => '500',
        'objectName' => 'FooA'
    ],
    [
        'anyTypeSort' => '4',
        'matchQuality' => '600',
        'objectName' => 'FooB'
    ],
    [
        'anyTypeSort' => '2',
        'matchQuality' => '700',
        'objectName' => 'FooC'
    ],
    [
        'anyTypeSort' => '3',
        'matchQuality' => '800',
        'objectName' => 'FooE'
    ],
    [
        'anyTypeSort' => '1',
        'matchQuality' => '900',
        'objectName' => 'FooF'
    ],
    [
        'anyTypeSort' => '3',
        'matchQuality' => '800',
        'objectName' => 'FooG'
    ]
];

$sortedPropertiesDirections = [
    'anyTypeSort' => SORT_ASC,
    'matchQuality' => SORT_DESC,
    'objectName' => SORT_ASC
];

$arraySorter = new \JanMaennig\Sorty\ArrayValueSorter();

$result = $arraySorter->sorting($collection, $sortedPropertiesDirections);
