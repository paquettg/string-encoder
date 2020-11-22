<?php

declare(strict_types=1);

namespace StringEncoder\DTO;

use StringEncoder\Contracts\DTO\EncodingDTOInterface;
use StringEncoder\Contracts\OptionsInterface;
use StringEncoder\Discovery\ValidatorDiscovery;
use StringEncoder\Exceptions\InvalidEncodingException;
use StringEncoder\MB\Validator;
use StringEncoder\Options;

final class EncodingDTO implements EncodingDTOInterface
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
    private function __construct(string $encoding, ?Validator $validator = null, OptionsInterface $options = null)
    {
        if ($validator === null) {
            $validator = ValidatorDiscovery::find();
        }
        if ($options === null) {
            $options = new Options();
        }

        if (!$validator->validateEncoding($encoding, $options->isCaseSensitiveEncoding())) {
            throw new InvalidEncodingException('Encoding "' . $encoding . '" is not supported by this system.');
        }
        if (!$options->isCaseSensitiveEncoding()) {
            // we need to potential fix the encoding string provided with the correct case.
            $encoding = $validator->determineEncoding($encoding, $options->isCaseSensitiveEncoding());
        }

        $this->encoding = $encoding;
    }

    /**
     * @throws InvalidEncodingException
     *
     * @internal
     */
    public static function makeFromString(string $encoding, ?Validator $validator = null, OptionsInterface $options = null): EncodingDTO
    {
        return new EncodingDTO($encoding, $validator, $options);
    }

    public function getEncoding(): string
    {
        return $this->encoding;
    }
}
