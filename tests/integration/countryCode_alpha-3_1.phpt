--TEST--
countryCode()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator;
use Respect\Validation\Rules\CountryCode;

var_dump(Validator::countryCode(CountryCode::ALPHA3)->validate('BRA'));
?>
--EXPECTF--
bool(true)
