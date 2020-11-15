<?php

declare(strict_types=1);

namespace StringEncoder\Discovery;

use StringEncoder\Contracts\Discovery\ValidatorDiscoveryInterface;
use StringEncoder\MB\Validator;

final class ValidatorDiscovery implements ValidatorDiscoveryInterface
{
    /**
     * @var Validator|null
     */
    private static $validator = null;

    public static function find(): Validator
    {
        if (self::$validator === null) {
            self::$validator = new Validator();
        }

        return self::$validator;
    }
}
