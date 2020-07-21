--CREDITS--
Ismael Elias <ismael.esq@hotmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PrimeNumberException;
use Respect\Validation\Validator as v;

try {
    v::primeNumber()->check(10);
} catch (PrimeNumberException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::primeNumber())->check(3);
} catch (PrimeNumberException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::primeNumber()->assert('Foo');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::primeNumber())->assert('+7');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
10 must be a valid prime number
3 must not be a valid prime number
- "Foo" must be a valid prime number
- "+7" must not be a valid prime number
