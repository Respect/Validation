--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CountryCodeException;
use Respect\Validation\Validator as v;

try {
    v::countryCode()->check('1');
} catch (CountryCodeException $exception) {
    echo $exception->getMessage();
}
?>
--EXPECTF--
"1" must be a valid country
