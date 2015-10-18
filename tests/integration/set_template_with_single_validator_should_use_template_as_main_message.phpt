--TEST--
setTemplate() with single validator should use template as main message
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationExceptionInterface;
use Respect\Validation\Rules\Callback;
use Respect\Validation\Validator;

try {
    Validator::callback('is_int')->setTemplate('{{name}} is not tasty')->assert('something');
} catch (NestedValidationExceptionInterface $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"something" is not tasty
