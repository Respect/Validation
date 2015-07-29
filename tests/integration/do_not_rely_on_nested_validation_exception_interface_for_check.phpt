--TEST--
Do not rely on nested validation exception interface for check
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationExceptionInterface;
use Respect\Validation\Exceptions\ValidationExceptionInterface;
use Respect\Validation\Validator;

$usernameValidator = Validator::alnum('_')->length(1, 15)->noWhitespace();
try {
    $usernameValidator->check('really messed up screen#name');
} catch (NestedValidationExceptionInterface $e) {
    echo 'Check used NestedValidationException';
} catch (ValidationExceptionInterface $e) {
    echo $e->getMessage();
}
?>
--EXPECTF--
"really messed up screen#name" must contain only letters (a-z), digits (0-9) and "_"
