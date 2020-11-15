<?php

declare(strict_types=1);

namespace StringEncoder\Contracts;

use StringEncoder\Contracts\DTO\MBStringDTOInterface;

interface ConvertWriteInterface
{
    public function toString(): string;

    public function toDTO(): MBStringDTOInterface;
}
