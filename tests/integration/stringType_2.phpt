--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\StringTypeException;

try {
    v::stringType()->check(42);
} catch (StringTypeException $e) {
    echo $e->getMainMessage();
}

?>
--EXPECTF--
42 must be a string
