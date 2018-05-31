--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\GreaterThanException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::greaterThan(12)->check(21);
} catch (GreaterThanException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::greaterThan('today'))->check('yesterday');
} catch (GreaterThanException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::greaterThan('1988-09-09')->assert('2018-09-09');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::greaterThan('b'))->assert('a');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
