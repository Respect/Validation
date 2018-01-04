--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::objectType()->assertAll(new stdClass());
v::objectType()->assert(new stdClass());
?>
--EXPECTF--
