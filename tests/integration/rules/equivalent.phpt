--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EquivalentException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::equivalent(true)->check(false);
} catch (EquivalentException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::equivalent('Something'))->check('someThing');
} catch (EquivalentException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::equivalent(123)->assert('true');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::equivalent(true))->assert(1);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
`FALSE` must be equivalent to `TRUE`
"someThing" must not be equivalent to "Something"
- "true" must be equivalent to 123
- 1 must not be equivalent to `TRUE`
