<?php

declare(strict_types=1);

namespace StringEncoder\Contracts;

use StringEncoder\Exceptions\ContentsFailedException;
use StringEncoder\Exceptions\InvalidEncodingException;

interface ConvertReadInterface
{
    /**
     * @throws InvalidEncodingException
     */
    public function fromString(string $value): ConvertWriteInterface;

    /**
     * @throws ContentsFailedException
     * @throws InvalidEncodingException
     */
    public function fromFile(string $filePath): ConvertWriteInterface;
}
