--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::positive()->assert(-10));
exceptionMessage(static fn() => v::not(v::positive())->assert(16));
exceptionFullMessage(static fn() => v::positive()->assert('a'));
exceptionFullMessage(static fn() => v::not(v::positive())->assert('165'));
?>
--EXPECT--
-10 must be positive
16 must not be positive
- "a" must be positive
- "165" must not be positive
