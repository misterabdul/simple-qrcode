<?php

namespace SimpleSoftwareIO\QrCode\DataTypes;

class SMS implements DataTypeInterface
{
    /**
     * The prefix of the QrCode.
     *
     * @var string
     */
    protected $prefix = 'sms:';

    /**
     * The separator between the variables.
     *
     * @var string
     */
    protected $separator = '&body=';

    /**
     * The phone number.
     *
     * @var string
     */
    protected $phoneNumber;

    /**
     * The SMS message.
     *
     * @var string
     */
    protected $message;

    /**
     * Generates the DataType Object and sets all of its properties.
     */
    public function create(array $arguments): void
    {
        $this->setProperties($arguments);
    }

    /**
     * Returns the correct QrCode format.
     */
    public function __toString(): string
    {
        return $this->buildSMSString();
    }

    /**
     * Sets the phone number and message for a sms message.
     */
    protected function setProperties(array $arguments): self
    {
        if (isset($arguments[0])) {
            $this->phoneNumber = $arguments[0];
        }
        if (isset($arguments[1])) {
            $this->message = $arguments[1];
        }

        return $this;
    }

    /**
     * Builds a SMS string.
     */
    protected function buildSMSString(): string
    {
        $sms = $this->prefix . $this->phoneNumber;

        if (isset($this->message)) {
            $sms .= $this->separator . $this->message;
        }

        return $sms;
    }
}
