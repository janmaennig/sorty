<?php

namespace JanMaennig\Sorty\Tests;

use JanMaennig\Sorty\ObjectStorageValueSorter;
use JanMaennig\Sorty\Tests\Fixtures\ObjectStorageValueSorterCollectionFixture;
use JanMaennig\Sorty\Tests\Fixtures\ObjectStorageValueSorterCollectionMissingIteratorInterfaceFixture;
use JanMaennig\Sorty\Tests\Fixtures\ObjectStorageValueSorterRecordFixture;

/**
 * @package JanMaennig\Sorty\Tests\Unit
 */
class ArrayAccessValueSorterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var  ObjectStorageValueSorter
     */
    private $arrayAccessSorter;

    /**
     * @var ObjectStorageValueSorterCollectionFixture
     */
    private $exampleCollection;

    /**
     * @var array
     */
    private $sortedPropertiesDirections;

    public function setUp()
    {
        $this->arrayAccessSorter = new ObjectStorageValueSorter();
        $this->exampleCollection = new ObjectStorageValueSorterCollectionFixture();

        $this->exampleCollection->offsetSet(
            0,
            new ObjectStorageValueSorterRecordFixture('Müller', 'Dresden', '04059 09409508')
        );
        $this->exampleCollection->offsetSet(
            1,
            new ObjectStorageValueSorterRecordFixture('Müller', 'Leipzig', '04059 09409508')
        );
        $this->exampleCollection->offsetSet(
            2,
            new ObjectStorageValueSorterRecordFixture('Maier', 'Stuttgart', '04059 09409508')
        );
        $this->exampleCollection->offsetSet(
            3,
            new ObjectStorageValueSorterRecordFixture('Schmidt', 'Hamburg', '04059 09409508')
        );

        $this->sortedPropertiesDirections = [
            'name' => SORT_ASC,
            'city' => SORT_DESC
        ];
    }

    public function testSortingWithValidParameters()
    {
        /** @var \Iterator $result */
        $result = $this->arrayAccessSorter->sorting($this->exampleCollection, $this->sortedPropertiesDirections);

        $this->assertEquals('Maier', $result->current()->getName());
        $result->next();
        $this->assertEquals('Müller', $result->current()->getName());
        $this->assertEquals('Leipzig', $result->current()->getCity());
        $result->next();
        $this->assertEquals('Müller', $result->current()->getName());
        $this->assertEquals('Dresden', $result->current()->getCity());
        $result->next();
        $this->assertEquals('Schmidt', $result->current()->getName());
    }

    public function testSortingInvalidCollectionObjectMissingIteratorInterface()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Record collection must be implement \ArrayAccess and \Iterator interface!');

        $this->arrayAccessSorter->sorting(new ObjectStorageValueSorterCollectionMissingIteratorInterfaceFixture(), []);
    }

    public function testSortingInvalidCollectionObjectMissingArrayAccessInterface()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Record collection must be implement \ArrayAccess and \Iterator interface!');

        $this->arrayAccessSorter->sorting(new ObjectStorageValueSorterCollectionMissingIteratorInterfaceFixture(), []);
    }

    public function testSortingWithInvalidSortingPropertyParameters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Property "firstName" in collection record not exists!');

        $invalidSortedPropertiesDirections = [
            'firstName' => SORT_ASC,
            'city' => SORT_DESC
        ];

        $this->arrayAccessSorter->sorting($this->exampleCollection, $invalidSortedPropertiesDirections);
    }

    public function testSortingWithInvalidSortingDirectionParameters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Sorting direction "foo" is an invalid sorting flag!');

        $invalidSortedPropertiesDirections = [
            'name' => 'foo',
            'city' => SORT_DESC
        ];

        $this->arrayAccessSorter->sorting($this->exampleCollection, $invalidSortedPropertiesDirections);
    }
}
