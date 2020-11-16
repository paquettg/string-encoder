# String Encoder

[![Build Status](https://travis-ci.org/paquettg/string-encoder.png)](https://travis-ci.org/paquettg/string-encoder)
[![Coverage Status](https://coveralls.io/repos/paquettg/string-encoder/badge.png)](https://coveralls.io/r/paquettg/string-encoder)

String Encode is a PHP is a simple, flexible, package with the goal of assisting developers with handling MB strings and encodings.

## Install

Install the latest version using composer.

```bash
$ composer require paquettg/string-encode
```

## Basic Usage

```php
<?php

use StringEncoder\Encoder;

$str     = "Calendrier de l'avent façon Necta!";
$encoder = new Encoder();
$newstr  = $encoder->convert()->fromString($str)->toString();
echo $newstr; // "Calendrier de l'avent façon Necta!" in UTF-8 encoding (default)
```

## Support String Encoder Financially

Get supported String Encoder and help fund the project with the [Tidelift Subscription](https://tidelift.com/subscription/pkg/packagist-paquettg-string-encode?utm_source=undefined&utm_medium=referral&utm_campaign=enterprise).

Tidelift delivers commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use.

## About

### Requirements

- String Encoder works with PHP 7.2, 7.3, and 7.4.

### Submitting bugs and feature requests

Bugs and feature requests are tracked on [GitHub](https://github.com/paquettg/string-encoder/issues)

### Authors

Gilles Paquette
See also the list of [contributors](https://github.com/paquettg/string-encoder/contributors) who participated in this project.

### License
String Encode is licensed under the MIT License - see [LICENSE](LICENSE.md) file for details.
