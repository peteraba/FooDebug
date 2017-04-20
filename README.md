FooDebug
============

Library for making multilingual applications in [Opulence](https://www.opulencephp.com/) easy.

[![Build Status](https://travis-ci.org/peteraba/FooDebug.svg?branch=master)](https://travis-ci.org/peteraba/FooDebug)
[![License](https://poser.pugx.org/peteraba/foo-debug/license)](https://packagist.org/packages/peteraba/foo-debug)
[![composer.lock](https://poser.pugx.org/peteraba/foo-debug/composerlock)](https://packagist.org/packages/peteraba/foo-debug)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/peteraba/FooDebug/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/peteraba/FooDebug/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/peteraba/FooDebug/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/peteraba/FooDebug/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/peteraba/FooDebug/badges/build.png?b=master)](https://scrutinizer-ci.com/g/peteraba/FooDebug/build-status/master)


Setup
-----

Install the library via composer:

```
composer install peteraba/foo-debug
```

Replace your exceptions config file
```php
# config/http/exceptions.php

<?php

use Foo\Debug\Exceptions\Handlers\Whoops\ExceptionHandler;
use Foo\Debug\Exceptions\Handlers\Whoops\ExceptionRenderer;
use Opulence\Environments\Environment;
use Whoops\Run;

/**
 * ----------------------------------------------------------
 * Define the exception handler
 * ----------------------------------------------------------
 *
 * The last parameter lists any exceptions you do not want to log
 */
$isDevelopment = Environment::getVar('ENV_NAME') === Environment::DEVELOPMENT;

$exceptionRenderer = new ExceptionRenderer(new Run(), $isDevelopment);

return new ExceptionHandler(
    $logger,
    $exceptionRenderer,
    [
        HttpException::class
    ]
);
```

