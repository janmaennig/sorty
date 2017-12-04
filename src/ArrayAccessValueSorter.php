<?php

namespace JanMaennig\Sorty;

/**
 * @package JanMaennig\Sorty
 */
class ArrayAccessValueSorter extends AbstractSorter
{
    /**
     * @param \ArrayAccess|\Iterator $recordCollection must be implement \ArrayAccess and \Iterator interface
     * @param array                  $sortingPropertiesDirection
     *
     * @return \ArrayAccess
     */
    public function sorting($recordCollection, $sortingPropertiesDirection)
    {
        if (!$recordCollection instanceof \ArrayAccess || !$recordCollection instanceof \Iterator) {
            throw new \InvalidArgumentException(
                'Record collection must be implement \ArrayAccess and \Iterator interface!'
            );
        }

        $unsortedList = iterator_to_array($recordCollection);

        $sortedList = parent::sortingArrayList($unsortedList, $sortingPropertiesDirection);

        $className = get_class($recordCollection);

        /** @var \ArrayAccess $resultObject */
        $resultObject = new $className();

        foreach ($sortedList as $offset => $value) {
            $resultObject->offsetSet($offset, $value);
        }

        return $resultObject;
    }

    /**
     * @param mixed  $record
     * @param string $propertyName
     *
     * @return mixed
     */
    protected function getSinglePropertyValueFromRecord($record, $propertyName)
    {
        $getMethodName = 'get' . ucfirst($propertyName);

        return $record->$getMethodName();
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
            $getMethodName = 'get' . ucfirst($property);
            if (property_exists($record, $property) === false || method_exists($record, $getMethodName) === false) {
                throw new \InvalidArgumentException(
                    sprintf('Property "%s" in collection record not exists!', $property)
                );
            }
        }
    }
}
