--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::primeNumber()->assert(10));
exceptionMessage(static fn() => v::not(v::primeNumber())->assert(3));
exceptionFullMessage(static fn() => v::primeNumber()->assert('Foo'));
exceptionFullMessage(static fn() => v::not(v::primeNumber())->assert('+7'));
?>
--EXPECT--
10 must be a prime number
3 must not be a prime number
- "Foo" must be a prime number
- "+7" must not be a prime number