--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EqualsException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::equals(123)->check(321);
} catch (EqualsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::equals(321))->check(321);
} catch (EqualsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::equals(123)->assert(321);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::equals(321))->assert(321);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
321 must equal 123
321 must not equal 321
- 321 must equal 123
- 321 must not equal 321
