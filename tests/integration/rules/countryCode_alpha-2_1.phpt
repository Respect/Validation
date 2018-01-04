--TEST--
countryCode()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator;

var_dump(Validator::countryCode()->isValid('BR'));
?>
--EXPECTF--
bool(true)
