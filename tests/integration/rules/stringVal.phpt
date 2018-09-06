--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\StringValException;
use Respect\Validation\Validator as v;

try {
    v::stringVal()->check([]);
} catch (StringValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::stringVal())->check(true);
} catch (StringValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::stringVal()->assert(new stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::stringVal())->assert(42);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
`{ }` must be a string
`TRUE` must not be string
- `[object] (stdClass: { })` must be a string
- 42 must not be string
