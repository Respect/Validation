--TEST--
not() should work by builder
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator;

var_dump(Validator::not(Validator::int())->validate(10));
?>
--EXPECTF--
bool(false)
