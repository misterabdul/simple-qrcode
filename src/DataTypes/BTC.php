<?php

namespace SimpleSoftwareIO\QrCode\DataTypes;

class BTC implements DataTypeInterface
{
    /**
     * The prefix of the QrCode.
     *
     * @var string
     */
    protected $prefix = 'bitcoin:';

    /**
     * The BitCoin address.
     *
     * @var string
     */
    protected $address;

    /**
     * The amount to send.
     *
     * @var int
     */
    protected $amount;

    /**
     * The BitCoin transaction label.
     *
     * @var string
     */
    protected $label;

    /**
     * The BitCoin message to send.
     *
     * @var string
     */
    protected $message;

    /**
     * The BitCoin return URL.
     *
     * @var string
     */
    protected $returnAddress;

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
        return $this->buildBitCoinString();
    }

    /**
     * Sets the BitCoin arguments.
     */
    protected function setProperties(array $arguments): self
    {
        if (isset($arguments[0])) {
            $this->address = $arguments[0];
        }

        if (isset($arguments[1])) {
            $this->amount = $arguments[1];
        }

        if (isset($arguments[2])) {
            $this->setOptions($arguments[2]);
        }

        return $this;
    }

    /**
     * Sets the optional BitCoin options.
     */
    protected function setOptions(array $options): self
    {
        if (isset($options['label'])) {
            $this->label = $options['label'];
        }

        if (isset($options['message'])) {
            $this->message = $options['message'];
        }

        if (isset($options['returnAddress'])) {
            $this->returnAddress = $options['returnAddress'];
        }

        return $this;
    }

    /**
     * Builds a BitCoin string.
     */
    protected function buildBitCoinString(): string
    {
        $query = \http_build_query([
            'amount'    => $this->amount,
            'label'     => $this->label,
            'message'  => $this->message,
            'r'         => $this->returnAddress,
        ]);

        $btc = $this->prefix . $this->address . '?' . $query;

        return $btc;
    }
}
