--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FactorException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::factor(3)->check(2);
} catch (FactorException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::factor(0))->check(300);
} catch (FactorException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::factor(5)->assert(3);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::factor(6))->assert(1);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
2 must be a factor of 3
300 must not be a factor of 0
- 3 must be a factor of 5
- 1 must not be a factor of 6
