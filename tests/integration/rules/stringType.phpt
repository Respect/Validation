--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\StringTypeException;
use Respect\Validation\Validator as v;

try {
    v::stringType()->check(42);
} catch (StringTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::stringType())->check('foo');
} catch (StringTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::stringType()->assert(true);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::stringType())->assert('bar');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
42 must be of type string
"foo" must not be of type string
- `TRUE` must be of type string
- "bar" must not be of type string
