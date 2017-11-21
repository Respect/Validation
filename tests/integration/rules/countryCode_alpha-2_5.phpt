--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CountryCodeException;
use Respect\Validation\Validator as v;

try {
    v::not(v::countryCode())->assert('BR');
} catch (CountryCodeException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"BR" must not be a valid country
