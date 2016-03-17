--TEST--
not() with recursion should update mode from related rules
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

try {
    $validator = Validator::not(
        Validator::not(
            Validator::not(
                Validator::not(
                    Validator::not(
                        Validator::intVal()->positive()
                    )
                )
            )
        )
    );
    $validator->check(2);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
- These rules must not pass for 2
