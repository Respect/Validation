--TEST--
alwaysValid()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::alwaysValid()->check(true);
v::alwaysValid()->check(false);
v::alwaysValid()->assert('string');
v::alwaysValid()->assert(new stdClass());
?>
--EXPECTF--
