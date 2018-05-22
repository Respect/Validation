--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IntTypeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::intType()->check(new stdClass());
} catch (IntTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::intType())->check(42);
} catch (IntTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::intType()->assert(INF);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::intType())->assert(1234567890);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
`[object] (stdClass: { })` must be of type integer
42 must not be of type integer
- `INF` must be of type integer
- 1234567890 must not be of type integer
