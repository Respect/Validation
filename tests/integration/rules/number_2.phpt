--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NumberException;
use Respect\Validation\Validator as v;

try {
    v::number()->check(acos(1.01));
} catch (NumberException $exception) {
    echo $exception->getMainMessage();
}

?>
--EXPECTF--
NaN must be a number
