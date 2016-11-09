<?php

namespace JanMaennig\Sorty\Tests;

use JanMaennig\Sorty\ArrayValueSorter;

/**
 * @package JanMaennig\Sorty\Tests
 */
class ArrayValueSorterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ArrayValueSorter */
    private $arraySorter;

    public function setUp()
    {
        $this->arraySorter = new ArrayValueSorter();
    }

    public function testArraySortingWithValidParameters()
    {
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

        $result = $this->arraySorter->sorting($collection, $sortedPropertiesDirections);

        $this->assertEquals(ArrayValueSorterFixture::$expectedCollection, $result);
    }

    public function testArraySortingWithInvalidSortingDirectionParameters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Sorting direction "foo" is an invalid sorting flag!');

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
            'anyTypeSort' => 'foo',
            'matchQuality' => SORT_DESC,
            'objectName' => SORT_ASC
        ];

        $this->arraySorter->sorting($collection, $sortedPropertiesDirections);
    }

    public function testArraySortingWithInvalidSortingPropertyParameters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Property "objectName" in collection record not exists!');

        $collection = [
            [
                'anyTypeSort' => '3',
                'matchQuality' => '800',
                'objectName' => 'FooE'
            ],
            [
                'anyTypeSort' => '2',
                'matchQuality' => '700',
            ],
            [
                'anyTypeSort' => '3',
                'matchQuality' => '800',
                'objectName' => 'FooE'
            ]
        ];

        $sortedPropertiesDirections = [
            'anyTypeSort' => SORT_ASC,
            'matchQuality' => SORT_DESC,
            'objectName' => SORT_ASC
        ];

        $this->arraySorter->sorting($collection, $sortedPropertiesDirections);
    }
}
