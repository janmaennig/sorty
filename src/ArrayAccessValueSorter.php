<?php

namespace JanMaennig\Sorty;

/**
 * @package JanMaennig\Sorty
 */
class ArrayAccessValueSorter
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
     * @var \ArrayAccess
     */
    private $resultObject;

    /**
     * @param \ArrayAccess|\Iterator $recordCollection must be implement \ArrayAccess and \Iterator interface
     * @param array                  $sortingPropertiesDirection
     *
     * @return \ArrayAccess
     */
    public function sorting(\ArrayAccess $recordCollection, array $sortingPropertiesDirection)
    {
        if (!$recordCollection instanceof \ArrayAccess || !$recordCollection instanceof \Iterator) {
            throw new \RuntimeException ('Record collection must be implement \ArrayAccess and \Iterator interface!');
        }

        $className = get_class($recordCollection);

        $this->resultObject = new $className();

        $recordCollection->

        return $this->resultObject;
    }
}
