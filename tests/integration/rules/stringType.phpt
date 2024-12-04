--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::stringType()->assert(42));
exceptionMessage(static fn() => v::not(v::stringType())->assert('foo'));
exceptionFullMessage(static fn() => v::stringType()->assert(true));
exceptionFullMessage(static fn() => v::not(v::stringType())->assert('bar'));
?>
--EXPECT--
42 must be a string
"foo" must not be a string
- `true` must be a string
- "bar" must not be a string