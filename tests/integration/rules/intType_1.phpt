--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::intType()->assertAll(42);
v::intType()->assert(1984);
?>
--EXPECTF--
