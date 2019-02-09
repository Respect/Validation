--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--TEST--
not() with recursion should update mode of its children
--FILE--
<?php

declare(strict_types=1);

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
--EXPECT--
- These rules must not pass for 2
