<?php

namespace JanMaennig\Sorty\Tests\Fixtures;

/**
 * @package JanMaennig\Sorty\Tests\Fixtures
 */
class ObjectStorageValueSorterCollectionFixture implements \ArrayAccess, \Iterator
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

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->collection);
    }

    /**
     *
     */
    public function next()
    {
        next($this->collection);
    }

    /**
     * @return int|mixed|null|string
     */
    public function key()
    {
        return key($this->collection);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return current($this->collection) !== false;
    }

    /**
     *
     */
    public function rewind()
    {
        reset($this->collection);
    }
}
