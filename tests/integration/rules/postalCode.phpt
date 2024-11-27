--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::postalCode('BR')->assert('1057BV'));
exceptionMessage(static fn() => v::not(v::postalCode('NL'))->assert('1057BV'));
exceptionFullMessage(static fn() => v::postalCode('BR')->assert('1057BV'));
exceptionFullMessage(static fn() => v::not(v::postalCode('NL'))->assert('1057BV'));
?>
--EXPECT--
"1057BV" must be a valid postal code on "BR"
"1057BV" must not be a valid postal code on "NL"
- "1057BV" must be a valid postal code on "BR"
- "1057BV" must not be a valid postal code on "NL"
