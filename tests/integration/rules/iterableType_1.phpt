--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::iterableType()->assert([1, 2, 3]);
v::iterableType()->check(new ArrayObject());
?>
--EXPECTF--
