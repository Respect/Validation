--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::intType()->assert(new stdClass()));
exceptionMessage(static fn() => v::not(v::intType())->assert(42));
exceptionFullMessage(static fn() => v::intType()->assert(INF));
exceptionFullMessage(static fn() => v::not(v::intType())->assert(1234567890));
?>
--EXPECT--
`stdClass {}` must be an integer
42 must not be an integer
- `INF` must be an integer
- 1234567890 must not be an integer