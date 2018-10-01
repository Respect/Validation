--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FibonacciException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::fibonacci()->check(1346268);
} catch (FibonacciException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::fibonacci())->check(10610209857723);
} catch (FibonacciException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::fibonacci()->assert(7);
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
1346268 must be a valid Fibonacci number
10610209857723 must not be a valid Fibonacci number
- 7 must be a valid Fibonacci number
- 21 must not be a valid Fibonacci number
