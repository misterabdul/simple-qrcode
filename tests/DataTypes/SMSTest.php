<?php

use PHPUnit\Framework\TestCase;
use SimpleSoftwareIO\QrCode\DataTypes\SMS;

class SMSTest extends TestCase
{
    /**
     * @var \SimpleSoftwareIO\QrCode\DataTypes\SMS
     */
    protected $sms;

    public function setUp(): void
    {
        $this->sms = new SMS();
    }

    public function test_it_generates_a_proper_format_with_a_phone_number(): void
    {
        $this->sms->create(['555-555-5555']);

        $properFormat = 'sms:555-555-5555';

        $this->assertEquals($properFormat, \strval($this->sms));
    }

    public function test_it_generate_a_proper_format_with_a_message(): void
    {
        $this->sms->create([null, 'foo']);

        $properFormat = 'sms:&body=foo';

        $this->assertEquals($properFormat, \strval($this->sms));
    }

    public function test_it_generates_a_proper_format_with_a_phone_number_and_message(): void
    {
        $this->sms->create(['555-555-5555', 'foo']);

        $properFormat = 'sms:555-555-5555&body=foo';

        $this->assertEquals($properFormat, \strval($this->sms));
    }
}
