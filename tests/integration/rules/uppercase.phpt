--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\UppercaseException;
use Respect\Validation\Validator as v;

try {
    v::uppercase()->check('lowercase');
} catch (UppercaseException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::uppercase()->assert('lowercase');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::uppercase())->check('UPPERCASE');
} catch (UppercaseException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::uppercase())->assert('UPPERCASE');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"lowercase" must be uppercase
- "lowercase" must be uppercase
"UPPERCASE" must not be uppercase
- "UPPERCASE" must not be uppercase
