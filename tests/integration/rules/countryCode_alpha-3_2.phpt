--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Rules\CountryCode;
use Respect\Validation\Validator as v;

v::countryCode(CountryCode::ALPHA3)->assert('BRA');
v::countryCode(CountryCode::ALPHA3)->assert('DEU');
v::countryCode(CountryCode::ALPHA3)->check('BRA');
v::countryCode(CountryCode::ALPHA3)->check('DEU');
?>
--EXPECTF--
