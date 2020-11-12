<?php

declare(strict_types=1);

namespace tests\MB;

use PHPUnit\Framework\TestCase;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\Exceptions\ConvertNoValueException;
use StringEncoder\MB\Convert;

class ConvertTest extends TestCase
{
    /**
     * @var Convert
     */
    private $convert;

    public function setUp()
    {
        $this->convert = new Convert(
            EncodingDTO::makeFromString('ISO-8859-1'),
            EncodingDTO::makeFromString('UTF-8')
        );
    }

    public function testToString()
    {
        $string = $this->convert->fromString('my string')->toString();
        $this->assertEquals('my string', $string);
    }

    public function testToStringWithoutFrom()
    {
        $this->expectException(ConvertNoValueException::class);
        $this->convert->toString();
    }
}
