--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

 declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

$validator = v::not(
    v::not(
        v::not(
            v::not(
                v::not(
                    v::intVal()->positive()
                )
            )
        )
    )
);

try {
    $validator->check(2);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    $validator->assert(2);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
2 must not be positive
- 2 must not be positive
