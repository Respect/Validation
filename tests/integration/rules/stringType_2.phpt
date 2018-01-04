--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\StringTypeException;
use Respect\Validation\Validator as v;

try {
    v::stringType()->assert(42);
} catch (StringTypeException $e) {
    echo $e->getMainMessage();
}

?>
--EXPECTF--
42 must be a string
