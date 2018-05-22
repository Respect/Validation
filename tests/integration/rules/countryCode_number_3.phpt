--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CountryCodeException;
use Respect\Validation\Rules\CountryCode;
use Respect\Validation\Validator as v;

try {
    v::countryCode(CountryCode::NUMERIC)->check('BRA');
} catch (CountryCodeException $exception) {
    echo $exception->getMessage();
}
?>
--EXPECTF--
"BRA" must be a valid country
