--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::floatType()->assert(42.23);
v::floatType()->check(1984.23);
?>
--EXPECTF--
