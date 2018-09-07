--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\LeapDateException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::leapDate('Y-m-d')->check('1989-02-29');
} catch (LeapDateException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::leapDate('Y-m-d'))->check('1988-02-29');
} catch (LeapDateException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::leapDate('Y-m-d')->assert('1990-02-29');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::leapDate('Y-m-d'))->assert('1992-02-29');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"1989-02-29" must be leap date
"1988-02-29" must not be leap date
- "1990-02-29" must be leap date
- "1992-02-29" must not be leap date
