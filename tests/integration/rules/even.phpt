--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EvenException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::even()->check(-1);
} catch (EvenException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::even()->assert(5);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::even())->check(6);
} catch (EvenException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::even())->assert(8);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
-1 must be an even number
- 5 must be an even number
6 must not be an even number
- 8 must not be an even number
