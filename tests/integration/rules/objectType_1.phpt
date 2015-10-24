--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::objectType()->assert(new stdClass());
v::objectType()->check(new stdClass());
?>
--EXPECTF--
