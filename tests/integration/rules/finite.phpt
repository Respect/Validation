--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::finite()->assert(''));
exceptionMessage(static fn() => v::not(v::finite())->assert(10));
exceptionFullMessage(static fn() => v::finite()->assert([12]));
exceptionFullMessage(static fn() => v::not(v::finite())->assert('123456'));
?>
--EXPECT--
"" must be a finite number
10 must not be a finite number
- `[12]` must be a finite number
- "123456" must not be a finite number
