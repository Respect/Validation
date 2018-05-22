--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ObjectTypeException;
use Respect\Validation\Validator as v;

try {
    v::objectType()->check([]);
} catch (ObjectTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::objectType())->check(new stdClass());
} catch (ObjectTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::objectType()->assert('test');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::objectType())->assert(new ArrayObject());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
`{ }` must be of type object
`[object] (stdClass: { })` must not be of type object
- "test" must be of type object
- `[traversable] (ArrayObject: { })` must not be of type object
