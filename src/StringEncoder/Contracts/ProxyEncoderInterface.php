<?php

declare(strict_types=1);

namespace StringEncoder\Contracts;

use StringEncoder\Encoder as EncoderImplementation;

interface ProxyEncoderInterface
{
    public static function mountFromEncoding(string $targetEncoding, ?string $sourceEncoding = null): void;

    public static function mount(string $className = 'Encoder', ?EncoderImplementation $encoder = null): bool;

    public static function getMountedEncoder(): ?EncoderImplementation;

    public static function setOptions(OptionsInterface $options): EncoderInterface;

    public static function unload(): void;

    public static function getTargetEncoding(): ?string;

    public static function setTargetEncoding(string $encoding): void;

    public static function getSourceEncoding(): ?string;

    public static function setSourceEncoding(string $encoding): void;

    public static function convert(): ConvertReadInterface;
}
