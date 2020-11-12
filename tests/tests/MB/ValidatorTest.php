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

    public function setUp()
    {
        $this->validator = new Validator();
    }

    public function testValidateEncoding()
    {
        $this->assertTrue($this->validator->validateEncoding('UTF-8'));
    }

    public function testValidateEncodingInvalid()
    {
        $this->assertFalse($this->validator->validateEncoding('NOTANENCODING'));
    }

    public function testValidateEncodingAlias()
    {
        $this->assertTrue($this->validator->validateEncoding('US-ASCII'));
    }
}
