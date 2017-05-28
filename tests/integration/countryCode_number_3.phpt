--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Rules\CountryCode;
use Respect\Validation\Exceptions\CountryCodeException;

try {
    v::countryCode(CountryCode::NUMERIC)->check('BRA');
} catch (CountryCodeException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"BRA" must be a valid country
