--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CountryCodeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::countryCode()->check('1');
} catch (CountryCodeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::countryCode())->check('BR');
} catch (CountryCodeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::countryCode()->assert('1');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::countryCode())->assert('BR');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"1" must be a valid country
"BR" must not be a valid country
- "1" must be a valid country
- "BR" must not be a valid country
