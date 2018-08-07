--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\NumberException;
use Respect\Validation\Validator as v;

try {
    v::number()->check(acos(1.01));
} catch (NumberException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::number())->check(42);
} catch (NumberException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::number()->assert(NAN);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::number())->assert(42);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
`NaN` must be a number
42 must not be a number
- `NaN` must be a number
- 42 must not be a number
