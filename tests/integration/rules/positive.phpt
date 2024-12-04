--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::positive()->assert(-10));
exceptionMessage(static fn() => v::not(v::positive())->assert(16));
exceptionFullMessage(static fn() => v::positive()->assert('a'));
exceptionFullMessage(static fn() => v::not(v::positive())->assert('165'));
?>
--EXPECT--
-10 must be a positive number
16 must not be a positive number
- "a" must be a positive number
- "165" must not be a positive number