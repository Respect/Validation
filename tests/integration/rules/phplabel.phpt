--TEST--
PhpLabel rule exception should not be thrown for valid inputs
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PhpLabelException;
use Respect\Validation\Validator as v;

try {
    v::phpLabel()->check('f o o');
} catch (PhpLabelException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::phpLabel())->check('correctOne');
} catch (PhpLabelException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::phpLabel()->assert('0wner');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::phpLabel())->assert('Respect');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"f o o" must be a valid PHP label
"correctOne" must not be a valid PHP label
- "0wner" must be a valid PHP label
- "Respect" must not be a valid PHP label
