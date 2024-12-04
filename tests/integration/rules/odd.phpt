--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::odd()->assert(2));
exceptionMessage(static fn() => v::not(v::odd())->assert(7));
exceptionFullMessage(static fn() => v::odd()->assert(2));
exceptionFullMessage(static fn() => v::not(v::odd())->assert(9));
?>
--EXPECT--
2 must be an odd number
7 must be an even number
- 2 must be an odd number
- 9 must be an even number