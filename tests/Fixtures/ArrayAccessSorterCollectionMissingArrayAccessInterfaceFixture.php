<?php

namespace JanMaennig\Sorty\Tests\Fixtures;

/**
 * @package JanMaennig\Sorty\Tests\Fixtures
 */
class ArrayAccessSorterCollectionMissingArrayAccessInterfaceFixture implements \Iterator
{
    /**
     * @var array
     */
    private $collection = [];

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
