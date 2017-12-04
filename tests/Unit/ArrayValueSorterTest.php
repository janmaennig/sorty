<?php

namespace JanMaennig\Sorty\Tests;

use JanMaennig\Sorty\ArrayValueSorter;
use JanMaennig\Sorty\Tests\Fixtures\ArrayValueSorterFixture;

/**
 * @package JanMaennig\Sorty\Tests
 */
class ArrayValueSorterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var  ArrayValueSorter
     */
    private $arraySorter;

    /**
     * @var array
     */
    private $exampleCollection = [];

    /**
     * @var array
     */
    private $sortedPropertiesDirections = [];

    public function setUp()
    {
        $this->arraySorter = new ArrayValueSorter();
        $this->exampleCollection = [
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

        $this->sortedPropertiesDirections = [
            'anyTypeSort' => SORT_ASC,
            'matchQuality' => SORT_DESC,
            'objectName' => SORT_ASC
        ];
    }

    public function testSortingWithValidParameters()
    {
        $result = $this->arraySorter->sorting($this->exampleCollection, $this->sortedPropertiesDirections);

        $this->assertEquals(ArrayValueSorterFixture::$expectedCollection, $result);
    }

    public function testSortingWithInvalidSortingDirectionParameters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Sorting direction "foo" is an invalid sorting flag!');

        $invalidSortedPropertiesDirections = [
            'anyTypeSort' => 'foo',
            'matchQuality' => SORT_DESC,
            'objectName' => SORT_ASC
        ];

        $this->arraySorter->sorting($this->exampleCollection, $invalidSortedPropertiesDirections);
    }

    public function testSortingWithInvalidSortingPropertyParameters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Property "objectId" in collection record not exists!');

        $invalidSortedPropertiesDirections = [
            'anyTypeSort' => SORT_ASC,
            'matchQuality' => SORT_DESC,
            'objectId' => SORT_ASC
        ];

        $this->arraySorter->sorting($this->exampleCollection, $invalidSortedPropertiesDirections);
    }
}
