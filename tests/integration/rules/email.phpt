--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::email()->assert('batman'));
exceptionMessage(static fn() => v::not(v::email())->assert('bruce.wayne@gothancity.com'));
exceptionFullMessage(static fn() => v::email()->assert('bruce wayne'));
exceptionFullMessage(static fn() => v::not(v::email())->assert('iambatman@gothancity.com'));
?>
--EXPECT--
"batman" must be a valid email address
"bruce.wayne@gothancity.com" must not be an email address
- "bruce wayne" must be a valid email address
- "iambatman@gothancity.com" must not be an email address