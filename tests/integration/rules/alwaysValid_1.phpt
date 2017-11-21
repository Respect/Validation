--TEST--
alwaysValid()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::alwaysValid()->assert(true);
v::alwaysValid()->assert(false);
v::alwaysValid()->assertAll('string');
v::alwaysValid()->assertAll(new stdClass());
?>
--EXPECTF--
