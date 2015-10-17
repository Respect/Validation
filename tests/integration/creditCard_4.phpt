--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\CreditCardException;

try {
	v::creditCard()->check(null);
} catch (CreditCardException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--
null must be a valid Credit Card number