--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\LowercaseException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::lowercase()->check('UPPERCASE');
} catch (LowercaseException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::lowercase())->check('lowercase');
} catch (LowercaseException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::lowercase()->assert('UPPERCASE');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::lowercase())->assert('lowercase');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
"UPPERCASE" must be lowercase
"lowercase" must not be lowercase
- "UPPERCASE" must be lowercase
- "lowercase" must not be lowercase
