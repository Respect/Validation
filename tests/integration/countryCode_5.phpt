--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\CountryCodeException;

try {
    v::not(v::countryCode())->check('BR');
} catch (CountryCodeException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"BR" must not be a valid country
