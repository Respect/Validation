--TEST--
countryCode()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator;

var_dump(Validator::countryCode()->validate('BR'));
?>
--EXPECTF--
bool(true)
