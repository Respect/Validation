--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Rules\CountryCode;
use Respect\Validation\Validator as v;

try {
    v::not(v::countryCode(CountryCode::NUMERIC))->assert('076');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--
- "076" must not be a valid country
