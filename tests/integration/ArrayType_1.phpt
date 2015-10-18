--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::ArrayType()->assert(array());
v::ArrayType()->check(array());

?>
--EXPECTF--
