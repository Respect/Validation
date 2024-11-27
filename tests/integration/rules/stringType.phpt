--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::stringType()->assert(42));
exceptionMessage(static fn() => v::not(v::stringType())->assert('foo'));
exceptionFullMessage(static fn() => v::stringType()->assert(true));
exceptionFullMessage(static fn() => v::not(v::stringType())->assert('bar'));
?>
--EXPECT--
42 must be of type string
"foo" must not be of type string
- `true` must be of type string
- "bar" must not be of type string
