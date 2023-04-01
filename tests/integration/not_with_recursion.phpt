--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

 declare(strict_types=1);

require 'vendor/autoload.php';

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

exceptionMessage(static fn() => $validator->check(2));
exceptionFullMessage(static fn() => $validator->assert(2));
?>
--EXPECT--
2 must not be positive
- 2 must not be positive
