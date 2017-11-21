--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::stringType()->assertAll(42);
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
- 42 must be a string
