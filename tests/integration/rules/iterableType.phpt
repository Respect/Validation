--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IterableTypeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::iterableType()->check(3);
} catch (IterableTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::iterableType())->check([2, 3]);
} catch (IterableTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::iterableType()->assert('String');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::iterableType())->assert(new stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
3 must be iterable
`{ 2, 3 }` must not be iterable
- "String" must be iterable
- `[object] (stdClass: { })` must not be iterable
