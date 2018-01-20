--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NumberException;
use Respect\Validation\Validator as v;

try {
    v::not(v::number())->check(42);
} catch (NumberException $exception) {
    echo $exception->getMainMessage();
}

?>
--EXPECTF--
42 must not be a number
