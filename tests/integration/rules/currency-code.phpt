--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CurrencyCodeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::currencyCode()->check('batman');
} catch (CurrencyCodeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::currencyCode())->check('BRL');
} catch (CurrencyCodeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::currencyCode()->assert('ppz');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::currencyCode())->assert('GBP');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"batman" must be a valid currency
"BRL" must not be a valid currency
- "ppz" must be a valid currency
- "GBP" must not be a valid currency
