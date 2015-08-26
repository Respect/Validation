--TEST--
not() with recursion should update mode from related rules
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationExceptionInterface;

try {
    $validator = Validator::not(
        Validator::not(
            Validator::not(
                Validator::not(
                    Validator::not(
                        Validator::int()->positive()
                    )
                )
            )
        )
    );
    $validator->check(2);
} catch (NestedValidationExceptionInterface $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
\-These rules must not pass for 2
