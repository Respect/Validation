--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::boolType()->check(false);
v::boolType()->assert(true);
?>
--EXPECTF--