--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::intType()->assert(42);
v::intType()->check(1984);
?>
--EXPECTF--
