<?php

declare(strict_types=1);

namespace StringEncoder\Contracts;

interface ConvertReadInterface
{
    public function fromString(string $value): ConvertWriteInterface;
}
