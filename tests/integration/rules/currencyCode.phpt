--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::currencyCode()->assert('batman'));
exceptionMessage(static fn() => v::not(v::currencyCode())->assert('BRL'));
exceptionFullMessage(static fn() => v::currencyCode()->assert('ppz'));
exceptionFullMessage(static fn() => v::not(v::currencyCode())->assert('GBP'));
?>
--EXPECT--
"batman" must be a valid currency code
"BRL" must not be a valid currency code
- "ppz" must be a valid currency code
- "GBP" must not be a valid currency code