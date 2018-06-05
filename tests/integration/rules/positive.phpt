--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PositiveException;
use Respect\Validation\Validator as v;

try {
    v::positive()->check(-10);
} catch (PositiveException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::positive())->check(16);
} catch (PositiveException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::positive()->assert('a');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::positive())->assert('165');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
-10 must be positive
16 must not be positive
- "a" must be positive
- "165" must not be positive
