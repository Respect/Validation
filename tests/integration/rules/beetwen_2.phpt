--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\MaxException;

try {
    v::intType()->between(1, 2)->check(42);
} catch (MaxException $e) {
    echo $e->getMainMessage().PHP_EOL;
}
--EXPECTF--
42 must be lower than or equals 2
