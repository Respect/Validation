--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::iterableType()->assertAll([1, 2, 3]);
v::iterableType()->assert(new ArrayObject());
?>
--EXPECTF--
