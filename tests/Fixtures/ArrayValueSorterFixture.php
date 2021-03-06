<?php

namespace JanMaennig\Sorty\Tests\Fixtures;

/**
 * @package JanMaennig\Sorty\Tests\Fixtures
 */
class ArrayValueSorterFixture
{
    public static $expectedCollection = [
        [
            'anyTypeSort' => '1',
            'matchQuality' => '900',
            'objectName' => 'FooF'
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
            'anyTypeSort' => '3',
            'matchQuality' => '800',
            'objectName' => 'FooG'
        ],
        [
            'anyTypeSort' => '3',
            'matchQuality' => '500',
            'objectName' => 'FooA'
        ],
        [
            'anyTypeSort' => '4',
            'matchQuality' => '600',
            'objectName' => 'FooB'
        ]
    ];
}
