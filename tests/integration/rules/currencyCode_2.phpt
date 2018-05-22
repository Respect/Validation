--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CurrencyCodeException;
use Respect\Validation\Validator as v;

try {
    v::currencyCode()->check('batman');
} catch (CurrencyCodeException $e) {
    echo $e->getMessage();
}
?>
--EXPECTF--
"batman" must be a valid currency
