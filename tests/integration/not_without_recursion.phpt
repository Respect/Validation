--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--TEST--
not() with recursion should update mode of its children
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator;

exceptionMessage(static function () {
    $validator = Validator::not(
        Validator::intVal()->positive()
    );
    $validator->check(2);
});
?>
--EXPECT--
2 must not be positive
