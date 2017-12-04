<?php

namespace JanMaennig\Sorty\Tests\Fixtures;

/**
 * @package JanMaennig\Sorty\Tests\Fixtures
 */
class ArrayAccessSorterCollectionMissingIteratorInterfaceFixture implements \ArrayAccess
{
    /**
     * @var array
     */
    private $collection = [];

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->collection[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->collection[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->collection[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->collection[$offset]);
    }
}
