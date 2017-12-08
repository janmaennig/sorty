<?php

namespace JanMaennig\Sorty;

/**
 * @package JanMaennig\Sorty
 */
class ArrayValueSorter extends AbstractSorter
{
    /**
     * @param array $recordCollection
     * @param array $sortingPropertiesDirection
     *
     * @return array
     */
    public function sorting(array $recordCollection, array $sortingPropertiesDirection)
    {
        $this->validateSortingPropertiesDirection($recordCollection, $sortingPropertiesDirection);

        return parent::sortingArrayList($recordCollection, $sortingPropertiesDirection);
    }

    /**
     * @param string $property
     * @param array  $collection
     *
     * @throws \InvalidArgumentException if property in collection record not exists
     */
    protected function validatePropertyInCollectionExists($property, array $collection)
    {
        foreach ($collection as $record) {
            if (key_exists($property, $record) === false) {
                throw new \InvalidArgumentException(
                    sprintf('Property "%s" in collection record not exists!', $property)
                );
            }
        }
    }
}
