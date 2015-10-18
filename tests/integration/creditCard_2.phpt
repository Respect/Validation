--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CreditCardException;
use Respect\Validation\Validator as v;

try {
    v::creditCard()->check(0);
} catch (CreditCardException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--
0 must be a valid Credit Card number