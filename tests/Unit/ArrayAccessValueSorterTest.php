<?php

namespace JanMaennig\Sorty\Tests;

use JanMaennig\Sorty\ArrayAccessValueSorter;
use JanMaennig\Sorty\Tests\Fixtures\ArrayAccessSorterCollectionFixture;
use JanMaennig\Sorty\Tests\Fixtures\ArrayAccessSorterCollectionMissingIteratorInterfaceFixture;
use JanMaennig\Sorty\Tests\Fixtures\ArrayAccessSorterRecordFixture;

/**
 * @package JanMaennig\Sorty\Tests\Unit
 */
class ArrayAccessValueSorterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ArrayAccessValueSorter */
    private $arrayAccessSorter;

    public function setUp()
    {
        $this->arrayAccessSorter = new ArrayAccessValueSorter();
    }

    public function testSortingWithValidParameters()
    {
        $exampleCollection = new ArrayAccessSorterCollectionFixture();

        $exampleCollection->offsetSet(
            0,
            new ArrayAccessSorterRecordFixture('Müller', 'Dresden', '04059 09409508')
        );
        $exampleCollection->offsetSet(
            1,
            new ArrayAccessSorterRecordFixture('Müller', 'Leipzig', '04059 09409508')
        );
        $exampleCollection->offsetSet(
            2,
            new ArrayAccessSorterRecordFixture('Maier', 'Stuttgart', '04059 09409508')
        );
        $exampleCollection->offsetSet(
            3,
            new ArrayAccessSorterRecordFixture('Schmidt', 'Hamburg', '04059 09409508')
        );

        $sortedPropertiesDirections = [
            'name' => SORT_ASC,
            'city' => SORT_DESC
        ];

        /** @var \Iterator $result */
        $result = $this->arrayAccessSorter->sorting($exampleCollection, $sortedPropertiesDirections);

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

        $this->arrayAccessSorter->sorting(new ArrayAccessSorterCollectionMissingIteratorInterfaceFixture(), []);
    }

    public function testSortingInvalidCollectionObjectMissingArrayAccessInterface()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Record collection must be implement \ArrayAccess and \Iterator interface!');

        $this->arrayAccessSorter->sorting(new ArrayAccessSorterCollectionMissingIteratorInterfaceFixture(), []);
    }

    public function testSortingWithInvalidSortingPropertyParameters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Property "first_name" in collection record not exists!');

        $exampleCollection = new ArrayAccessSorterCollectionFixture();

        $exampleCollection->offsetSet(
            0,
            new ArrayAccessSorterRecordFixture('Müller', 'Dresden', '04059 09409508')
        );
        $exampleCollection->offsetSet(
            1,
            new ArrayAccessSorterRecordFixture('Müller', 'Leipzig', '04059 09409508')
        );
        $exampleCollection->offsetSet(
            2,
            new ArrayAccessSorterRecordFixture('Maier', 'Stuttgart', '04059 09409508')
        );
        $exampleCollection->offsetSet(
            3,
            new ArrayAccessSorterRecordFixture('Schmidt', 'Hamburg', '04059 09409508')
        );

        $sortedPropertiesDirections = [
            'first_name' => SORT_ASC,
            'city' => SORT_DESC
        ];

        $this->arrayAccessSorter->sorting($exampleCollection, $sortedPropertiesDirections);
    }
}
