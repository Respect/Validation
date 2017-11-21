--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::boolType()->assert(false);
v::boolType()->assertAll(true);
?>
--EXPECTF--