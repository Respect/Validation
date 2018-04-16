--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\TimeException;
use Respect\Validation\Validator as v;

try {
    v::time()->check('2018-01-30');
} catch (TimeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::time())->check('09:25:46');
} catch (TimeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::time()->assert('2018-01-30');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::time('g:i A'))->assert('8:13 AM');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"2018-01-30" must be a valid time in the format "23:59:59"
"09:25:46" must not be a valid time in the format "23:59:59"
- "2018-01-30" must be a valid time in the format "23:59:59"
- "8:13 AM" must not be a valid time in the format "11:59 PM"
