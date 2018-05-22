--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ArrayValException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::arrayVal()->check('Bla %123');
} catch (ArrayValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::arrayVal())->check([42]);
} catch (ArrayValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::arrayVal()->assert(new stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::arrayVal())->assert(new ArrayObject([2, 3]));
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"Bla %123" must be an array value
`{ 42 }` must not be an array value
- `[object] (stdClass: { })` must be an array value
- `[traversable] (ArrayObject: { 2, 3 })` must not be an array value
