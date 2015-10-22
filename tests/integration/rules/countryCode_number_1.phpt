--TEST--
countryCode()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Rules\CountryCode;
use Respect\Validation\Validator;

var_dump(Validator::countryCode(CountryCode::NUMERIC)->validate('076'));
?>
--EXPECTF--
bool(true)
