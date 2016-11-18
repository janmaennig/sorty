<?php

namespace JanMaennig\Sorty;

/**
 * @package JanMaennig\Sorty
 */
class ArrayValueSorter
{
    /**
     * @var array
     */
    private $validSortingDirection = [
        SORT_REGULAR,
        SORT_NUMERIC,
        SORT_STRING,
        SORT_DESC,
        SORT_ASC,
        SORT_LOCALE_STRING,
        SORT_NATURAL,
        SORT_FLAG_CASE
    ];

    /**
     * @param array $recordCollection
     * @param array $sortingPropertiesDirection
     *
     * @return array
     */
    public function sorting(array $recordCollection, array $sortingPropertiesDirection)
    {
        $this->validateSortingPropertiesDirection($recordCollection, $sortingPropertiesDirection);

        $sortList = [];

        foreach ($recordCollection as $key => $value) {
            foreach (array_keys($sortingPropertiesDirection) as $property) {
                $sortList[$property][$key] = $value[$property];
            }
        }

        $sortingParameters = $this->generateFunctionCallParameters($sortingPropertiesDirection, $sortList);

        $sortingParameters[] = &$recordCollection;

        call_user_func_array(
            'array_multisort',
            $sortingParameters
        );

        return $recordCollection;
    }

    /**
     * @param array $sortingPropertiesDirection
     */
    private function validateSortingPropertiesDirection(array $recordCollection, array $sortingPropertiesDirection)
    {
        foreach ($sortingPropertiesDirection as $property => $direction) {
            $this->validatePropertyInCollectionExists($property, $recordCollection);
            $this->validateSortingDirection($direction);
        }
    }

    /**
     * @param string $property
     * @param array  $collection
     *
     * @throws \InvalidArgumentException if property in collection record not exists
     */
    private function validatePropertyInCollectionExists($property, array $collection)
    {
        foreach ($collection as $record) {
            if (key_exists($property, $record) === false) {
                throw new \InvalidArgumentException(
                    sprintf('Property "%s" in collection record not exists!', $property)
                );
            }
        }
    }

    /**
     * @param string $sortingDirection
     *
     * @throws \InvalidArgumentException if sorting direction is an invalid sorting flag
     */
    private function validateSortingDirection($sortingDirection)
    {
        if (in_array($sortingDirection, $this->validSortingDirection, true) === false) {
            throw new \InvalidArgumentException(
                sprintf('Sorting direction "%s" is an invalid sorting flag!', $sortingDirection)
            );
        }
    }

    /**
     * @param array $sortingPropertiesDirection
     * @param array $sortList
     *
     * @return array
     */
    protected function generateFunctionCallParameters(array $sortingPropertiesDirection, array $sortList)
    {
        $sortingParameters = [];
        foreach ($sortingPropertiesDirection as $property => $direction) {
            $sortingParameters[] = $sortList[$property];
            $sortingParameters[] = $direction;
        }

        return $sortingParameters;
    }
}
