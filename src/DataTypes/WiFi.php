<?php

namespace SimpleSoftwareIO\QrCode\DataTypes;

class WiFi implements DataTypeInterface
{
    /**
     * The prefix of the QrCode.
     *
     * @var string
     */
    protected $prefix = 'WIFI:';

    /**
     * The separator between the variables.
     *
     * @var string
     */
    protected $separator = ';';

    /**
     * The encryption of the network.  WEP or WPA.
     *
     * @var string
     */
    protected $encryption;

    /**
     * The SSID of the WiFi network.
     *
     * @var string
     */
    protected $ssid;

    /**
     * The password of the network.
     *
     * @var string
     */
    protected $password;

    /**
     * Whether the network is a hidden SSID or not.
     *
     * @var bool
     */
    protected $hidden;

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
        return $this->buildWifiString();
    }

    /**
     * Builds the WiFi string.
     */
    protected function buildWifiString(): string
    {
        $wifi = $this->prefix;

        if (isset($this->encryption)) {
            $wifi .= 'T:'.$this->encryption.$this->separator;
        }
        if (isset($this->ssid)) {
            $wifi .= 'S:'.$this->ssid.$this->separator;
        }
        if (isset($this->password)) {
            $wifi .= 'P:'.$this->password.$this->separator;
        }
        if (isset($this->hidden)) {
            $wifi .= 'H:'.$this->hidden.$this->separator;
        }

        return $wifi;
    }

    /**
     * Sets the WiFi properties.
     */
    protected function setProperties(array $arguments): self
    {
        $arguments = $arguments[0];
        if (isset($arguments['encryption'])) {
            $this->encryption = $arguments['encryption'];
        }
        if (isset($arguments['ssid'])) {
            $this->ssid = $arguments['ssid'];
        }
        if (isset($arguments['password'])) {
            $this->password = $arguments['password'];
        }
        if (isset($arguments['hidden'])) {
            $this->hidden = $arguments['hidden'];
        }

        return $this;
    }
}
