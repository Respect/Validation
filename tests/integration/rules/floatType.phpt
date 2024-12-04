--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::floatType()->assert('42.33'));
exceptionMessage(static fn() => v::not(v::floatType())->assert(INF));
exceptionFullMessage(static fn() => v::floatType()->assert(true));
exceptionFullMessage(static fn() => v::not(v::floatType())->assert(2.0));
?>
--EXPECT--
"42.33" must be float
`INF` must not be float
- `true` must be float
- 2.0 must not be float