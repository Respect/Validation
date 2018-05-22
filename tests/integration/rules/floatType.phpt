--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FloatTypeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::floatType()->check('42.33');
} catch (FloatTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::floatType())->check(INF);
} catch (FloatTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::floatType()->assert(true);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::floatType())->assert(2.0);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"42.33" must be of type float
`INF` must not be of type float
- `TRUE` must be of type float
- 2.0 must not be of type float
