--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\CreditCardException;

try {
	v::not(v::creditCard())->check(5555444433331111);
} catch (CreditCardException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--
5555444433331111 must not be a valid Credit Card number