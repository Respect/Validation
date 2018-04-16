--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ScalarValException;
use Respect\Validation\Validator as v;

try {
    v::scalarVal()->check([]);
} catch (ScalarValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::scalarVal())->check(true);
} catch (ScalarValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::scalarVal()->assert(new stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::scalarVal())->assert(42);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
`{ }` must be a scalar value
`TRUE` must not be a scalar value
- `[object] (stdClass: { })` must be a scalar value
- 42 must not be a scalar value
