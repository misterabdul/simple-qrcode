<?php

namespace SimpleSoftwareIO\QrCode\DataTypes;

use BaconQrCode\Exception\InvalidArgumentException;

class Email implements DataTypeInterface
{
    /**
     * The prefix of the QrCode.
     *
     * @var string
     */
    protected $prefix = 'mailto:';

    /**
     * The email address.
     *
     * @var string
     */
    protected $email;

    /**
     * The subject of the email.
     *
     * @var string
     */
    protected $subject;

    /**
     * The body of an email.
     *
     * @var string
     */
    protected $body;

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
        return $this->buildEmailString();
    }

    /*
     * Builds the email string.
     */
    protected function buildEmailString(): string
    {
        $email = $this->prefix . $this->email;

        if (isset($this->subject) || isset($this->body)) {
            $data = [
                'subject' => $this->subject,
                'body'    => $this->body,
            ];
            $email .= '?' . \http_build_query($data);
        }

        return $email;
    }

    /**
     * Sets the objects properties.
     */
    protected function setProperties(array $arguments): self
    {
        if (isset($arguments[0])) {
            $this->setEmail($arguments[0]);
        }
        if (isset($arguments[1])) {
            $this->subject = $arguments[1];
        }
        if (isset($arguments[2])) {
            $this->body = $arguments[2];
        }

        return $this;
    }

    /**
     * Sets the email property.
     * 
     * @throws \BaconQrCode\Exception\InvalidArgumentException
     */
    protected function setEmail(string $email): self
    {
        if ($this->isValidEmail($email)) {
            $this->email = $email;
        }

        return $this;
    }

    /**
     * Ensures an email is valid.
     *
     * @throws \BaconQrCode\Exception\InvalidArgumentException
     */
    protected function isValidEmail(string $email): bool
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email provided');
        }

        return true;
    }
}
