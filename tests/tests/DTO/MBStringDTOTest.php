<?php

declare(strict_types=1);

namespace tests\DTO;

use PHPUnit\Framework\TestCase;
use StringEncoder\Contracts\DTO\EncodingDTOInterface;
use StringEncoder\Contracts\OptionsInterface;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\DTO\MBStringDTO;
use StringEncoder\Exceptions\InvalidEncodingException;
use StringEncoder\Options;

class MBStringDTOTest extends TestCase
{
    /**
     * @var \StringEncoder\Contracts\DTO\MBStringDTOInterface
     */
    private $mbStringDTO;

    public function setUp()
    {
        $this->mbStringDTO = MBStringDTO::makeFromString('test string', new Options());
    }

    public function testMakeFromString()
    {
        $this->assertEquals('test string', $this->mbStringDTO->getString());
    }

    public function testGetOptions()
    {
        $this->assertTrue($this->mbStringDTO->getOptions() instanceof OptionsInterface);
    }

    public function testGetEncodingDTO()
    {
        $this->assertTrue($this->mbStringDTO->getEncodingDTO() instanceof EncodingDTOInterface);
    }

    public function testWrongEncoding()
    {
        $this->expectException(InvalidEncodingException::class);
        MBStringDTO::makeFromString('ひらがな', new Options(), EncodingDTO::makeFromString('ASCII'));
    }
}
