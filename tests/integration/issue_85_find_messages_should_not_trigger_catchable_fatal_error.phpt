--TEST--
Issue #85: findMessages() should not trigger catchable fatal error
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

$usernameValidator = Validator::alnum('_')->length(1, 15)->noWhitespace();
try {
    $usernameValidator->assert('really messed up screen#name');
} catch (NestedValidationException $e) {
    print_r($e->findMessages(['alnum', 'length', 'noWhitespace']));
}
?>
--EXPECTF--
Array
(
    [alnum] => "really messed up screen#name" must contain only letters (a-z), digits (0-9) and "_"
    [length] => "really messed up screen#name" must have a length between 1 and 15
    [noWhitespace] => "really messed up screen#name" must not contain whitespace
)
