<?php

namespace SimpleSoftwareIO\QrCode\DataTypes;

interface DataTypeInterface
{
    /**
     * Generates the DataType Object and sets all of its properties.
     */
    public function create(array $arguments): void;

    /**
     * Returns the correct QrCode format.
     */
    public function __toString(): string;
}
