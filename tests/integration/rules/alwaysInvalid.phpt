--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AlwaysInvalidException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::alwaysInvalid()->check('whatever');
} catch (AlwaysInvalidException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::alwaysInvalid()->assert('');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"whatever" is always invalid
- "" is always invalid
