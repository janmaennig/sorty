<?php

namespace JanMaennig\Sorty;

/**
 * @package JanMaennig\Sorty
 */
abstract class AbstractSorter
{
    /**
     * @var array
     */
    protected $validSortingDirection = [
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
    protected function sortingArrayList(array $recordCollection, array $sortingPropertiesDirection)
    {
        $this->validateSortingPropertiesDirection($recordCollection, $sortingPropertiesDirection);

        $sortList = [];

        foreach ($recordCollection as $key => $value) {
            foreach (array_keys($sortingPropertiesDirection) as $property) {
                $sortList[$property][$key] = $this->getSinglePropertyValueFromRecord($value, $property);
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
     * @param mixed  $record
     * @param string $propertyName
     *
     * @return mixed
     */
    protected function getSinglePropertyValueFromRecord($record, $propertyName)
    {
        return $record[$propertyName];
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

    /**
     * @param string $sortingDirection
     *
     * @throws \InvalidArgumentException if sorting direction is an invalid sorting flag
     */
    protected function validateSortingDirection($sortingDirection)
    {
        if (in_array($sortingDirection, $this->validSortingDirection, true) === false) {
            throw new \InvalidArgumentException(
                sprintf('Sorting direction "%s" is an invalid sorting flag!', $sortingDirection)
            );
        }
    }

    /**
     * @param array $sortingPropertiesDirection
     */
    protected function validateSortingPropertiesDirection(array $recordCollection, array $sortingPropertiesDirection)
    {
        foreach ($sortingPropertiesDirection as $property => $direction) {
            $this->validatePropertyInCollectionExists($property, $recordCollection);
            $this->validateSortingDirection($direction);
        }
    }
}
