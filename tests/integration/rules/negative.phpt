--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::negative()->assert(16));
exceptionMessage(static fn() => v::not(v::negative())->assert(-10));
exceptionFullMessage(static fn() => v::negative()->assert('a'));
exceptionFullMessage(static fn() => v::not(v::negative())->assert('-144'));
?>
--EXPECT--
16 must be a negative number
-10 must not be a negative number
- "a" must be a negative number
- "-144" must not be a negative number