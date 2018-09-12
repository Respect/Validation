--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\LeapYearException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::leapYear()->check('2009');
} catch (LeapYearException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::leapYear())->check('2008');
} catch (LeapYearException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::leapYear()->assert('2009-02-29');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::leapYear())->assert('2008');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"2009" must be a leap year
"2008" must not be a leap year
- "2009-02-29" must be a leap year
- "2008" must not be a leap year
