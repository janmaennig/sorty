<?php

namespace JanMaennig\Sorty\Tests;

use JanMaennig\Sorty\ObjectStorageValueSorter;
use JanMaennig\Sorty\Tests\Fixtures\ObjectStorageValueSorterCollectionFixture;
use JanMaennig\Sorty\Tests\Fixtures\ObjectStorageValueSorterCollectionMissingIteratorInterfaceFixture;
use JanMaennig\Sorty\Tests\Fixtures\ObjectStorageValueSorterRecordFixture;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * @package JanMaennig\Sorty\Tests\Unit
 */
class ObjectStorageValueSorterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var  ObjectStorageValueSorter
     */
    private $objectStorageSorter;

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
        $this->objectStorageSorter = new ObjectStorageValueSorter();
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
        $result = $this->objectStorageSorter->sorting($this->exampleCollection, $this->sortedPropertiesDirections);

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

        $this->objectStorageSorter->sorting(new ObjectStorageValueSorterCollectionMissingIteratorInterfaceFixture(), []);
    }

    public function testSortingInvalidCollectionObjectMissingObjectStorageInterface()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Record collection must be implement \ArrayAccess and \Iterator interface!');

        $this->objectStorageSorter->sorting(new ObjectStorageValueSorterCollectionMissingIteratorInterfaceFixture(), []);
    }

    public function testSortingWithInvalidSortingPropertyParameters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Property "firstName" in collection record not exists!');

        $invalidSortedPropertiesDirections = [
            'firstName' => SORT_ASC,
            'city' => SORT_DESC
        ];

        $this->objectStorageSorter->sorting($this->exampleCollection, $invalidSortedPropertiesDirections);
    }

    public function testSortingWithInvalidSortingDirectionParameters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Sorting direction "foo" is an invalid sorting flag!');

        $invalidSortedPropertiesDirections = [
            'name' => 'foo',
            'city' => SORT_DESC
        ];

        $this->objectStorageSorter->sorting($this->exampleCollection, $invalidSortedPropertiesDirections);
    }

    public function testTypo3ExtbaseObjectStorageSorting()
    {
        /** @var ObjectStorage $typo3ObjectStorage */
        $typo3ObjectStorage = new ObjectStorage();

        $typo3ObjectStorage->offsetSet(
            new ObjectStorageValueSorterRecordFixture('Müller', 'Dresden', '04059 09409508'),
            0
        );
        $typo3ObjectStorage->offsetSet(
            new ObjectStorageValueSorterRecordFixture('Müller', 'Leipzig', '04059 09409508'),
            1
        );
        $typo3ObjectStorage->offsetSet(
            new ObjectStorageValueSorterRecordFixture('Maier', 'Stuttgart', '04059 09409508'),
            2
        );
        $typo3ObjectStorage->offsetSet(
            new ObjectStorageValueSorterRecordFixture('Schmidt', 'Hamburg', '04059 09409508'),
            3
        );

        $result = $this->objectStorageSorter->sorting($typo3ObjectStorage, $this->sortedPropertiesDirections);

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
}
