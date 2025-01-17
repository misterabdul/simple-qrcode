<?php

namespace SimpleSoftwareIO\QrCode\DataTypes;

class PhoneNumber implements DataTypeInterface
{
    /**
     * The prefix of the QrCode.
     *
     * @var string
     */
    protected $prefix = 'tel:';

    /**
     * The phone number.
     *
     * @var string
     */
    protected $phoneNumber;

    /**
     * Generates the DataType Object and sets all of its properties.
     */
    public function create(array $arguments): void
    {
        $this->phoneNumber = $arguments[0];
    }

    /**
     * Returns the correct QrCode format.
     */
    public function __toString(): string
    {
        return $this->prefix . $this->phoneNumber;
    }
}
