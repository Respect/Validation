--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FibonacciException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::fibonacci()->check(4);
} catch (FibonacciException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::fibonacci())->check(5);
} catch (FibonacciException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::fibonacci()->assert(16);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::fibonacci())->assert(21);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
4 must be a valid Fibonacci number
5 must not be a valid Fibonacci number
- 16 must be a valid Fibonacci number
- 21 must not be a valid Fibonacci number
