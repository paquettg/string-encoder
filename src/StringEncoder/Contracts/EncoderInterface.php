<?php

declare(strict_types=1);

namespace StringEncoder\Contracts;

interface EncoderInterface
{
    public function setOptions(OptionsInterface $options): EncoderInterface;

    public function getTargetEncoding(): ?string;

    public function setTargetEncoding(string $encoding): void;

    public function getSourceEncoding(): ?string;

    public function setSourceEncoding(string $encoding): void;

    public function convert(): ConvertReadInterface;
}
