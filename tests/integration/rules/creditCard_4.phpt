--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CreditCardException;
use Respect\Validation\Validator as v;

try {
    v::creditCard('Visa')->check(3566002020360505);
} catch (CreditCardException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--
3566002020360505 must be a valid "Visa" Credit Card number
