--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PerfectSquareException;
use Respect\Validation\Validator as v;

try {
    v::perfectSquare()->check(250);
} catch (PerfectSquareException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::perfectSquare())->check(9);
} catch (PerfectSquareException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::perfectSquare()->assert(7);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::perfectSquare())->assert(400);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
250 must be a valid perfect square
9 must not be a valid perfect square
- 7 must be a valid perfect square
- 400 must not be a valid perfect square
