<?php

declare(strict_types=1);

namespace StringEncoder\Contracts;

use StringEncoder\Contracts\DTO\MBStringDTOInterface;
use StringEncoder\Exceptions\ContentsFailedException;
use StringEncoder\Exceptions\ConvertNoValueException;

interface ConvertWriteInterface
{
    /**
     * @throws ConvertNoValueException
     */
    public function toString(): string;

    /**
     * @throws ContentsFailedException
     * @throws ConvertNoValueException
     */
    public function toFile(string $path): void;

    /**
     * @throws ConvertNoValueException
     */
    public function toDTO(): MBStringDTOInterface;
}
