--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::creditCard('Discover')->assert(3566002020360505));
exceptionMessage(static fn() => v::not(v::creditCard('Visa'))->assert(4024007153361885));
exceptionFullMessage(static fn() => v::creditCard('MasterCard')->assert(3566002020360505));
exceptionFullMessage(static fn() => v::not(v::creditCard())->assert(5555444433331111));
?>
--EXPECT--
3566002020360505 must be a valid Discover credit card number
4024007153361885 must not be a valid Visa credit card number
- 3566002020360505 must be a valid MasterCard credit card number
- 5555444433331111 must not be a valid credit card number
