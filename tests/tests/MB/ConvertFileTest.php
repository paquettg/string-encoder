<?php

declare(strict_types=1);

namespace tests\MB;

use PHPUnit\Framework\TestCase;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\Exceptions\ContentsFailedException;
use StringEncoder\Exceptions\ConvertNoValueException;
use StringEncoder\MB\Convert;

class ConvertFileTest extends TestCase
{
    /**
     * @var Convert
     */
    private $convert;

    public function setUp(): void
    {
        $this->convert = new Convert(
            EncodingDTO::makeFromString('ISO-8859-1'),
            EncodingDTO::makeFromString('UTF-8')
        );
    }

    public function testFromFile()
    {
        $string = $this->convert->fromFile('./tests/data/data.txt')->toString();
        $this->assertEquals('this is a random string, so random it is the most random string.', $string);
    }

    public function testFromFileNotFound()
    {
        $this->expectException(ContentsFailedException::class);
        $this->convert->fromFile('./path/not/fount.txt');
    }

    public function testToFile()
    {
        $this->convert->fromFile('./tests/data/data.txt')->toFile('./tests/data/test.data.txt');
        $string = $this->convert->fromFile('./tests/data/test.data.txt')->toString();
        \unlink('./tests/data/test.data.txt');
        $this->assertEquals('this is a random string, so random it is the most random string.', $string);
    }

    public function testToFileNoFrom()
    {
        $this->expectException(ConvertNoValueException::class);
        $this->convert->toFile('./tests/data/test.data.txt');
    }

    public function testToFileDirectory()
    {
        $this->expectException(ContentsFailedException::class);
        $this->convert->fromFile('./tests/data/data.txt')->toFile('./tests');
    }
}
