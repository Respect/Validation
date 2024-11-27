--TEST--
not() with recursion should update mode of its children
--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator;

exceptionMessage(static function (): void {
    $validator = Validator::not(
        Validator::intVal()->positive()
    );
    $validator->assert(2);
});
?>
--EXPECT--
2 must not be an integer number
