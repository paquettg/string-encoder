<?php

declare(strict_types=1);

namespace StringEncoder\Contracts\Discovery;

use StringEncoder\MB\Validator;

interface ValidatorDiscoveryInterface
{
    public static function find(): Validator;
}
