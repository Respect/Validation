--FILE--
<?php

 declare(strict_types=1);

require 'vendor/autoload.php';

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
2 must not be an integer number
- These rules must not pass for 2
  - 2 must not be an integer number
  - 2 must not be positive
