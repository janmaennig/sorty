<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use \JanMaennig\Sorty\Tests\Fixtures\ArrayAccessSorterCollectionFixture;
use \JanMaennig\Sorty\Tests\Fixtures\ArrayAccessSorterRecordFixture;

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

$arraySorter = new \JanMaennig\Sorty\ArrayAccessValueSorter();

$result = $arraySorter->sorting($exampleCollection, $sortedPropertiesDirections);

print_r($result);
