<?php

declare(strict_types=1);

namespace StringEncoder\Contracts;

interface ConvertWriteInterface
{
    public function fromString(string $value): ConvertReadInterface;
}
