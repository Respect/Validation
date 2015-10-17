--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Rules\CountryCode;
use Respect\Validation\Exceptions\CountryCodeException;

try {
    v::countryCode(CountryCode::ALPHA3)->check('1');
} catch (CountryCodeException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"1" must be a valid country
