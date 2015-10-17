--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\CreditCardException;

try {
	v::creditCard()->assert('4111 1111 1111 1111');
} catch (CreditCardException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--