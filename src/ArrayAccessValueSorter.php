<?php

namespace JanMaennig\Sorty;

/**
 * @package JanMaennig\Sorty
 */
class ArrayAccessValueSorter
{
    /**
     * @var string
     */
    private $getSortingPropertyMethod = '';

    /**
     * @var \ArrayAccess
     */
    private $resultObject;

    /**
     * @param \ArrayAccess|\Iterator $recordCollection must be implement \ArrayAccess and \Iterator interface
     * @param string                 $sortingProperty
     * @param string                 $sortingDirection
     *
     * @return \Iterator
     */
    public function sorting($recordCollection, $sortingProperty, $sortingDirection)
    {
        if (!$recordCollection instanceof \ArrayAccess || !$recordCollection instanceof \Iterator) {
            throw new \RuntimeException('Record collection must be implement \ArrayAccess and \Iterator interface!');
        }

        $unsortedCollection = iterator_to_array($recordCollection);

        $sortingCallBack = 'sortAsc';
        if ($sortingDirection === 'DESC') {
            $sortingCallBack = 'sortDesc';
        }

        $this->getSortingPropertyMethod = 'get' . ucfirst($sortingProperty);

        uasort($unsortedCollection, [$this, $sortingCallBack]);

        $className = get_class($recordCollection);

        $this->resultObject = new $className();

        foreach ($unsortedCollection as $offset => $record) {
            $this->resultObject->offsetSet($offset, $record);
        }

        return $this->resultObject;
    }

    /**
     * @param $first
     * @param $second
     *
     * @return int
     */
    private function sortAsc($first, $second)
    {
        $getSortingPropertyMethod = $this->getSortingPropertyMethod;
        if ($first->$getSortingPropertyMethod() == $second->$getSortingPropertyMethod()) {
            return 0;
        }

        return ($first->$getSortingPropertyMethod() < $second->$getSortingPropertyMethod()) ? -1 : 1;
    }

    /**
     * @param $first
     * @param $second
     *
     * @return int
     */
    private function sortDesc($first, $second)
    {
        $getSortingPropertyMethod = $this->getSortingPropertyMethod;
        if ($first->$getSortingPropertyMethod() == $second->$getSortingPropertyMethod()) {
            return 0;
        }

        return ($first->$getSortingPropertyMethod() > $second->$getSortingPropertyMethod()) ? -1 : 1;
    }
}
