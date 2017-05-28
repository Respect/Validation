--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Rules\CountryCode;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::countryCode(CountryCode::NUMERIC)->assert('BRA');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--
\-"BRA" must be a valid country
