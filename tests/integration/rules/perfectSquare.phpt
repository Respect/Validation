--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::perfectSquare()->assert(250));
exceptionMessage(static fn() => v::not(v::perfectSquare())->assert(9));
exceptionFullMessage(static fn() => v::perfectSquare()->assert(7));
exceptionFullMessage(static fn() => v::not(v::perfectSquare())->assert(400));
?>
--EXPECT--
250 must be a perfect square number
9 must not be a perfect square number
- 7 must be a perfect square number
- 400 must not be a perfect square number