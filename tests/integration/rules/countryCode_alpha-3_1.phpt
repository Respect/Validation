--TEST--
countryCode()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Rules\CountryCode;
use Respect\Validation\Validator;

var_dump(Validator::countryCode(CountryCode::ALPHA3)->isValid('BRA'));
?>
--EXPECTF--
bool(true)
