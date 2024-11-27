--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::perfectSquare()->check(250));
exceptionMessage(static fn() => v::not(v::perfectSquare())->check(9));
exceptionFullMessage(static fn() => v::perfectSquare()->assert(7));
exceptionFullMessage(static fn() => v::not(v::perfectSquare())->assert(400));
?>
--EXPECT--
250 must be a valid perfect square
9 must not be a valid perfect square
- 7 must be a valid perfect square
- 400 must not be a valid perfect square
