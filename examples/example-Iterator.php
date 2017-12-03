<?php

require_once(__DIR__ . '/../vendor/autoload.php');

class ExampleCollection implements \ArrayAccess, \Iterator
{
    /**
     * @var array
     */
    private $collection = [];

    public function offsetExists($offset)
    {
        return isset($this->collection[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->collection[$offset];
    }

    /**
     * Offset to set
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->collection[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->collection[$offset]);
    }

    public function current()
    {
        return current($this->collection);
    }

    /**
     * Move forward to next element
     *
     * @link  http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        next($this->collection);
    }

    /**
     * Return the key of the current element
     *
     * @link  http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->collection);
    }

    /**
     * Checks if current position is valid
     *
     * @link  http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return current($this->collection) !== false;
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @link  http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        reset($this->collection);
    }
}

class ExampleCollectionRecord
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $telephone;

    public function __construct($name, $city, $telephone)
    {
        $this->name = $name;
        $this->city = $city;
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}

$exampleCollection = new ExampleCollection();

$exampleCollection->offsetSet(0, new ExampleCollectionRecord('Müller', 'Dresden', '04059 09409508'));
$exampleCollection->offsetSet(1, new ExampleCollectionRecord('Müller', 'Leipzig', '04059 09409508'));
$exampleCollection->offsetSet(2, new ExampleCollectionRecord('Maier', 'Stuttgart', '04059 09409508'));
$exampleCollection->offsetSet(3, new ExampleCollectionRecord('Schmidt', 'Hamburg', '04059 09409508'));

$sortedPropertiesDirections = [
    'name' => SORT_ASC,
    'city' => SORT_DESC
];

$arraySorter = new \JanMaennig\Sorty\ArrayAccessValueSorter();

$result = $arraySorter->sorting($exampleCollection, $sortedPropertiesDirections);

print_r($result);
