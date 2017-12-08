<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use \JanMaennig\Sorty\Tests\Fixtures\ObjectStorageValueSorterCollectionFixture;
use \JanMaennig\Sorty\Tests\Fixtures\ObjectStorageValueSorterRecordFixture;

$exampleCollection = new ObjectStorageValueSorterCollectionFixture();

$exampleCollection->offsetSet(
    0,
    new ObjectStorageValueSorterRecordFixture('Müller', 'Dresden', '04059 09409508')
);
$exampleCollection->offsetSet(
    1,
    new ObjectStorageValueSorterRecordFixture('Müller', 'Leipzig', '04059 09409508')
);
$exampleCollection->offsetSet(
    2,
    new ObjectStorageValueSorterRecordFixture('Maier', 'Stuttgart', '04059 09409508')
);
$exampleCollection->offsetSet(
    3,
    new ObjectStorageValueSorterRecordFixture('Schmidt', 'Hamburg', '04059 09409508')
);

$sortedPropertiesDirections = [
    'name' => SORT_ASC,
    'city' => SORT_DESC
];

$objectStorageSorter = new \JanMaennig\Sorty\ObjectStorageValueSorter();

$result = $objectStorageSorter->sorting($exampleCollection, $sortedPropertiesDirections);

print_r($result);
