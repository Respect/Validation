--TEST--
setTemplate() with single validator should use template as main message
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Rules\Callback;
use Respect\Validation\Validator;

$rule = Validator::callback('is_int')->setTemplate('{{name}} is not tasty');
try {
    $rule->assert('something');
} catch (NestedValidationException $e) {
    echo $e->getMainMessage();
}

echo PHP_EOL;

try {
    $rule->check('something');
} catch (NestedValidationException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"something" is not tasty
"something" is not tasty
