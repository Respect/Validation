--TEST--
not() with recursion should update mode from related rules
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ValidationExceptionInterface;
use Respect\Validation\Validator;

try {
    $validator = Validator::not(
        Validator::intVal()->positive()
    );
    $validator->check(2);
} catch (ValidationExceptionInterface $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}
?>
--EXPECTF--
2 must not be positive
