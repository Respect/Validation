--TEST--
countryCode()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator;
use Respect\Validation\Rules\CountryCode;

var_dump(Validator::countryCode(CountryCode::NUMERIC)->validate('076'));
?>
--EXPECTF--
bool(true)
