<?php

namespace JanMaennig\Sorty;

/**
 * @package JanMaennig\Sorty
 */
class ArrayValueSorter
{
    /**
     * @param array $recordCollection
     * @param array $sortingPropertiesDirection
     *
     * @return array
     */
    public function sorting(array $recordCollection, array $sortingPropertiesDirection)
    {
        foreach ($recordCollection as $key => $value) {
            foreach (array_keys($sortingPropertiesDirection) as $property) {
                $sortList[$property][$key] = $value[$property];
            }
        }

        call_user_func_array(
            'array_multisort',
            [
                $sortList['anyTypeSort'],
                SORT_ASC,
                $sortList['matchQuality'],
                SORT_DESC,
                $sortList['objectName'],
                SORT_ASC,
                &$recordCollection
            ]
        );

        return $recordCollection;
    }
}
