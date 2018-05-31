--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\MaxException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::max(10)->check(11);
} catch (MaxException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::max(10))->check(5);
} catch (MaxException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::max('today')->assert('tomorrow');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::max('b'))->assert('a');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
11 must be less than or equal to 10
5 must not be less than or equal to 10
- "tomorrow" must be less than or equal to "today"
- "a" must not be less than or equal to "b"
