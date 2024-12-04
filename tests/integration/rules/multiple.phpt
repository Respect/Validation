--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::multiple(3)->assert(22));
exceptionMessage(static fn() => v::not(v::multiple(3))->assert(9));
exceptionFullMessage(static fn() => v::multiple(2)->assert(5));
exceptionFullMessage(static fn() => v::not(v::multiple(5))->assert(25));
?>
--EXPECT--
22 must be a multiple of 3
9 must not be a multiple of 3
- 5 must be a multiple of 2
- 25 must not be a multiple of 5