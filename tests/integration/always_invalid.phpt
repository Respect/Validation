--TEST--
alwaysInvalid()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator;

var_dump(Validator::alwaysInvalid()->validate('sojdnfjsdnfojsdnfos dfsdofj sodjf '));
?>
--EXPECTF--
bool(false)
