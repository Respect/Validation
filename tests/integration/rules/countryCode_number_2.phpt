--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Rules\CountryCode;
use Respect\Validation\Validator as v;

v::countryCode(CountryCode::NUMERIC)->assert('076');
v::countryCode(CountryCode::NUMERIC)->assert('276');
v::countryCode(CountryCode::NUMERIC)->check('076');
v::countryCode(CountryCode::NUMERIC)->check('276');
?>
--EXPECTF--
