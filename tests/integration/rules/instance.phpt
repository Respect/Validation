--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\InstanceException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::instance(DateTime::class)->check('');
} catch (InstanceException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::instance(Traversable::class))->check(new \ArrayObject());
} catch (InstanceException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::instance(ArrayIterator::class)->assert(new stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::instance(stdClass::class))->assert(new stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"" must be an instance of "DateTime"
`[traversable] (ArrayObject: { })` must not be an instance of "Traversable"
- `[object] (stdClass: { })` must be an instance of "ArrayIterator"
- `[object] (stdClass: { })` must not be an instance of "stdClass"
