--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::arrayType()->assertAll([]);
v::arrayType()->assert([1, 2, 3]);
?>
--EXPECTF--
