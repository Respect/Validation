--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::countryCode()->assert('1'));
exceptionMessage(static fn() => v::not(v::countryCode())->assert('BR'));
exceptionFullMessage(static fn() => v::countryCode()->assert('1'));
exceptionFullMessage(static fn() => v::not(v::countryCode())->assert('BR'));
?>
--EXPECT--
"1" must be a valid country
"BR" must not be a valid country
- "1" must be a valid country
- "BR" must not be a valid country
