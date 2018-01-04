--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EqualsException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::equals(123)->assert(321);
} catch (EqualsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::equals(321))->assert(321);
} catch (EqualsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::equals(123)->assertAll(321);
} catch (ValidationException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::equals(321))->assertAll(321);
} catch (ValidationException $exception) {
    echo $exception->getMessage().PHP_EOL;
}
?>
--EXPECTF--
321 must equals 123
321 must not equals 321
- 321 must equals 123
- 321 must not equals 321
