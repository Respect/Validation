--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PrimeNumberException;
use Respect\Validation\Validator as v;

try {
    v::primeNumber()->check(10);
} catch (PrimeNumberException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::primeNumber())->check(3);
} catch (PrimeNumberException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::primeNumber()->assert('Foo');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::primeNumber())->assert('+7');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
10 must be a valid prime number
3 must not be a valid prime number
- "Foo" must be a valid prime number
- "+7" must not be a valid prime number
