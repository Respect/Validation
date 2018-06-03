--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\LowercaseException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::lowercase()->check('UPPERCASE');
} catch (LowercaseException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::lowercase())->check('lowercase');
} catch (LowercaseException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::lowercase()->assert('UPPERCASE');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::lowercase())->assert('lowercase');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"UPPERCASE" must be lowercase
"lowercase" must not be lowercase
- "UPPERCASE" must be lowercase
- "lowercase" must not be lowercase
