<?php

namespace SimpleSoftwareIO\QrCode\DataTypes;

class Geo implements DataTypeInterface
{
    /**
     * The prefix of the QrCode.
     *
     * @var string
     */
    protected $prefix = 'geo:';

    /**
     * The separator between the variables.
     *
     * @var string
     */
    protected $separator = ',';

    /**
     * The latitude.
     *
     * @var double
     */
    protected $latitude;

    /**
     * The longitude.
     *
     * @var double
     */
    protected $longitude;

    /**
     * Generates the DataType Object and sets all of its properties.
     */
    public function create(array $arguments): void
    {
        $this->latitude = $arguments[0];
        $this->longitude = $arguments[1];
    }

    /**
     * Returns the correct QrCode format.
     */
    public function __toString(): string
    {
        return $this->prefix
            . \strval($this->latitude)
            . $this->separator
            . \strval($this->longitude);
    }
}
