<?php

namespace JanMaennig\Sorty\Tests\Fixtures;

/**
 * @package JanMaennig\Sorty\Tests\Fixtures
 */
class ObjectStorageValueSorterRecordFixture
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
