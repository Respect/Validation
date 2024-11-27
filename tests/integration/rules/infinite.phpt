--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::infinite()->assert(-9));
exceptionMessage(static fn() => v::not(v::infinite())->assert(INF));
exceptionFullMessage(static fn() => v::infinite()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::infinite())->assert(INF * -1));
?>
--EXPECT--
-9 must be an infinite number
`INF` must not be an infinite number
- `stdClass {}` must be an infinite number
- `-INF` must not be an infinite number
