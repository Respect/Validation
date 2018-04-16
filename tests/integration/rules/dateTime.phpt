--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\DateTimeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::dateTime()->check('FooBarBazz');
} catch (DateTimeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::dateTime('c')->check('06-12-1995');
} catch (DateTimeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::dateTime()->assert('QuxQuuxx');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::dateTime('r')->assert(2018013030);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::dateTime())->check('4 days ago');
} catch (DateTimeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::dateTime('Y-m-d'))->check('1988-09-09');
} catch (DateTimeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::dateTime())->assert('+3 weeks');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::dateTime('d/m/y'))->assert('23/07/99');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"FooBarBazz" must be a valid date/time
"06-12-1995" must be a valid date/time in the format "2005-12-30T01:02:03+00:00"
- "QuxQuuxx" must be a valid date/time
- 2018013030 must be a valid date/time in the format "Fri, 30 Dec 2005 01:02:03 +0000"
"4 days ago" must not be a valid date/time
"1988-09-09" must not be a valid date/time in the format "2005-12-30"
- "+3 weeks" must not be a valid date/time
- "23/07/99" must not be a valid date/time in the format "30/12/05"
