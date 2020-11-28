<?php

declare(strict_types=1);

namespace tests\MB;

use PHPUnit\Framework\TestCase;
use StringEncoder\MB\Validator;

class ValidatorTest extends TestCase
{
    /**
     * @var Validator
     */
    private $validator;

    public function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testValidateEncoding()
    {
        $this->assertTrue($this->validator->validateEncoding('UTF-8', true));
    }

    public function testValidateEncodingCaseInsensitive()
    {
        $this->assertTrue($this->validator->validateEncoding('utf-8', false));
    }

    public function testValidateEncodingInvalid()
    {
        $this->assertFalse($this->validator->validateEncoding('NOTANENCODING', true));
    }

    public function testValidateEncodingInvaliCase()
    {
        $this->assertFalse($this->validator->validateEncoding('utf-8', true));
    }

    public function testValidateEncodingAlias()
    {
        $this->assertTrue($this->validator->validateEncoding('US-ASCII', true));
    }

    public function testValidateEncodingAliasCaseInsensitive()
    {
        $this->assertTrue($this->validator->validateEncoding('us-ascII', false));
    }
}
