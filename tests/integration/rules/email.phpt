--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::email()->assert('batman'));
exceptionMessage(static fn() => v::not(v::email())->assert('bruce.wayne@gothancity.com'));
exceptionFullMessage(static fn() => v::email()->assert('bruce wayne'));
exceptionFullMessage(static fn() => v::not(v::email())->assert('iambatman@gothancity.com'));
?>
--EXPECT--
"batman" must be valid email
"bruce.wayne@gothancity.com" must not be an email
- "bruce wayne" must be valid email
- "iambatman@gothancity.com" must not be an email
