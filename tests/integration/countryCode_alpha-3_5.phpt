--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Rules\CountryCode;
use Respect\Validation\Exceptions\CountryCodeException;

try {
    v::not(v::countryCode(CountryCode::ALPHA3))->check('BRA');
} catch (CountryCodeException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"BRA" must not be a valid country
