<?php

declare(strict_types=1);

namespace tests\MB;

use PHPUnit\Framework\TestCase;
use StringEncoder\MB\Convert;

class ConvertNoEncodingTest extends TestCase
{
    /**
     * @var Convert
     */
    private $convert;

    public function setUp()
    {
        $this->convert = new Convert();
    }

    public function testToString()
    {
        $string = $this->convert->fromString('my string')->toString();
        $this->assertEquals('my string', $string);
    }
}
