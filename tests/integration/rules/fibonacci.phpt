--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::fibonacci()->check(4));
exceptionMessage(static fn() => v::not(v::fibonacci())->check(5));
exceptionFullMessage(static fn() => v::fibonacci()->assert(16));
exceptionFullMessage(static fn() => v::not(v::fibonacci())->assert(21));
?>
--EXPECT--
4 must be a valid Fibonacci number
5 must not be a valid Fibonacci number
- 16 must be a valid Fibonacci number
- 21 must not be a valid Fibonacci number
