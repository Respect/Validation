--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\CreditCardException;

try {
	v::creditCard()->assert(0);
} catch (CreditCardException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--
0 must be a valid Credit Card number