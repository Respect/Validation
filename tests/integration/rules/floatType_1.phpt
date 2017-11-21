--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::floatType()->assertAll(42.23);
v::floatType()->assert(1984.23);
?>
--EXPECTF--
