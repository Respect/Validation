--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Rules\CountryCode;
use Respect\Validation\Validator as v;

try {
    v::countryCode(CountryCode::ALPHA3)->assert('1');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--
- "1" must be a valid country
