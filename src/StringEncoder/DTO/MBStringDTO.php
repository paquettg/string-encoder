<?php

declare(strict_types=1);

namespace StringEncoder\DTO;

use StringEncoder\Contracts\DTO\EncodingDTOInterface;
use StringEncoder\Contracts\DTO\MBStringDTOInterface;
use StringEncoder\Contracts\OptionsInterface;
use StringEncoder\Discovery\ValidatorDiscovery;
use StringEncoder\Exceptions\InvalidEncodingException;
use StringEncoder\MB\Validator;

final class MBStringDTO implements MBStringDTOInterface
{
    /**
     * @var string
     */
    private $string;

    /**
     * @var EncodingDTOInterface
     */
    private $encodingDTO;
    /**
     * @var OptionsInterface
     */
    private $options;

    /**
     * EncodingDTO constructor.
     *
     * @throws InvalidEncodingException
     */
    private function __construct(
        string $string,
        OptionsInterface $options,
        ?EncodingDTOInterface $encodingDTO = null,
        ?Validator $validator = null)
    {
        if ($validator === null) {
            $validator = ValidatorDiscovery::find();
        }
        if ($encodingDTO === null) {
            $encodingDTO = $options->getDefaultTargetEncoding();
        }

        if (!$validator->validateString($string, $encodingDTO)) {
            throw new InvalidEncodingException('String "' . $string . '" is not the current encoding of "' . $encodingDTO->getEncoding() . '".');
        }

        $this->options = $options;
        $this->encodingDTO = $encodingDTO;
        $this->string = $string;
    }

    /**
     * @throws InvalidEncodingException
     *
     * @internal
     */
    public static function makeFromString(
        string $string,
        OptionsInterface $options,
        ?EncodingDTOInterface $encodingDTO = null,
        ?Validator $validator = null
    ): MBStringDTOInterface {
        return new MBStringDTO($string, $options, $encodingDTO, $validator);
    }

    /**
     * @throws InvalidEncodingException
     *
     * @internal
     */
    public static function makeFromDTO(string $string, MBStringDTOInterface $MBStringDTO): MBStringDTOInterface
    {
        return new MBStringDTO($string, $MBStringDTO->getOptions(), $MBStringDTO->getEncodingDTO());
    }

    public function getString(): string
    {
        return $this->string;
    }

    public function getEncodingDTO(): EncodingDTOInterface
    {
        return $this->encodingDTO;
    }

    public function getOptions(): OptionsInterface
    {
        return $this->options;
    }
}
