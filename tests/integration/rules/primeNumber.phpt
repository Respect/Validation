--CREDITS--
Ismael Elias <ismael.esq@hotmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::primeNumber()->check(10));
exceptionMessage(static fn() => v::not(v::primeNumber())->check(3));
exceptionFullMessage(static fn() => v::primeNumber()->assert('Foo'));
exceptionFullMessage(static fn() => v::not(v::primeNumber())->assert('+7'));
?>
--EXPECT--
10 must be a valid prime number
3 must not be a valid prime number
- "Foo" must be a valid prime number
- "+7" must not be a valid prime number
