<?php

declare(strict_types=1);

namespace StringEncoder\DTO;

use StringEncoder\Discovery\ValidatorDiscovery;
use StringEncoder\Exceptions\InvalidEncodingException;
use StringEncoder\MB\Validator;

final class EncodingDTO
{
    /**
     * @var string
     */
    private $encoding;

    /**
     * EncodingDTO constructor.
     *
     * @throws InvalidEncodingException
     */
    private function __construct(string $encoding, ?Validator $validator = null)
    {
        if ($validator === null) {
            $validator = ValidatorDiscovery::find();
        }

        if (!$validator->validateEncoding($encoding)) {
            throw new InvalidEncodingException('Encoding "' . $encoding . '" is not supported by this system.');
        }

        $this->encoding = $encoding;
    }

    /**
     * @throws InvalidEncodingException
     */
    public static function makeFromString(string $encoding, ?Validator $validator = null): EncodingDTO
    {
        return new EncodingDTO($encoding, $validator);
    }

    public function getEncoding(): string
    {
        return $this->encoding;
    }
}
