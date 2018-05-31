--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\LessThanException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::lessThan(12)->check(21);
} catch (LessThanException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::lessThan('today'))->check('yesterday');
} catch (LessThanException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::lessThan('1988-09-09')->assert('2018-09-09');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::lessThan('b'))->assert('a');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
21 must be less than 12
"yesterday" must not be less than "today"
- "2018-09-09" must be less than "1988-09-09"
- "a" must not be less than "b"
