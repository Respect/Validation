--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::iterable()->assert([1, 2, 3]);
v::iterable()->check(new ArrayObject());
?>
--EXPECTF--
