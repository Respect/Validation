--TEST--
alwaysValid()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator;

var_dump(Validator::alwaysValid()->validate('sojdnfjsdnfojsdnfos dfsdofj sodjf '));
?>
--EXPECTF--
bool(true)
