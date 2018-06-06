--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\OddException;
use Respect\Validation\Validator as v;

try {
    v::odd()->check(2);
} catch (OddException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::odd())->check(7);
} catch (OddException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::odd()->assert(2);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::odd())->assert(9);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
2 must be an odd number
7 must not be an odd number
- 2 must be an odd number
- 9 must not be an odd number
