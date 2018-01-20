--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IdenticalException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::identical(123)->check(321);
} catch (IdenticalException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::identical(321))->check(321);
} catch (IdenticalException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::identical(123)->assert(321);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::identical(321))->assert(321);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
321 must be identical as 123
321 must not be identical as 321
- 321 must be identical as 123
- 321 must not be identical as 321
