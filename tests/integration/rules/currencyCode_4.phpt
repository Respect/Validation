--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CurrencyCodeException;
use Respect\Validation\Validator as v;

try {
    v::not(v::currencyCode())->assert('BRL');
} catch (CurrencyCodeException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"BRL" must not be a valid currency
