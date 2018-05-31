--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\MaxAgeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::maxAge(12)->check('50 years ago');
} catch (MaxAgeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::maxAge(12))->check('11 years ago');
} catch (MaxAgeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::maxAge(12, 'Y-m-d')->assert('1988-09-09');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::maxAge(12, 'Y-m-d'))->assert('2018-01-01');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"50 years ago" must be 12 years or less
"11 years ago" must not be 12 years or less
- "1988-09-09" must be 12 years or less
- "2018-01-01" must not be 12 years or less
