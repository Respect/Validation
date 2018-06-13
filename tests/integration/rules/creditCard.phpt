--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CreditCardException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::creditCard('Discover')->check(3566002020360505);
} catch (CreditCardException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::not(v::creditCard('Visa'))->check(4024007153361885);
} catch (CreditCardException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::creditCard('MasterCard')->assert(3566002020360505);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::creditCard())->assert(5555444433331111);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
3566002020360505 must be a valid "Discover" Credit Card number
4024007153361885 must not be a valid "Visa" Credit Card number
- 3566002020360505 must be a valid "MasterCard" Credit Card number
- 5555444433331111 must not be a valid Credit Card number
