--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\MultipleException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::multiple(3)->check(22);
} catch (MultipleException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::multiple(3))->check(9);
} catch (MultipleException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::multiple(2)->assert(5);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::multiple(5))->assert(25);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
22 must be multiple of 3
9 must not be multiple of 3
- 5 must be multiple of 2
- 25 must not be multiple of 5
