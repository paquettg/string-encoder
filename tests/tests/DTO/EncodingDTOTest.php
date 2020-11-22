<?php

declare(strict_types=1);

namespace tests\DTO;

use PHPUnit\Framework\TestCase;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\Exceptions\InvalidEncodingException;
use StringEncoder\Options;

class EncodingDTOTest extends TestCase
{
    public function testMakeFromString()
    {
        $encodingDTO = EncodingDTO::makeFromString('UTF-8');
        $this->assertEquals('UTF-8', $encodingDTO->getEncoding());
    }

    public function testMakeFromStringInvalid()
    {
        $this->expectException(InvalidEncodingException::class);
        EncodingDTO::makeFromString('NOTANENCODING');
    }

    public function testMakeFromStringCaseInsensitive()
    {
        $encodingDTO = EncodingDTO::makeFromString('utf-8', null, (new Options())->setCaseSensitiveEncoding(false));
        $this->assertEquals('UTF-8', $encodingDTO->getEncoding());
    }
}
