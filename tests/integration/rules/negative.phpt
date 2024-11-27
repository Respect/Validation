--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::negative()->assert(16));
exceptionMessage(static fn() => v::not(v::negative())->assert(-10));
exceptionFullMessage(static fn() => v::negative()->assert('a'));
exceptionFullMessage(static fn() => v::not(v::negative())->assert('-144'));
?>
--EXPECT--
16 must be negative
-10 must not be negative
- "a" must be negative
- "-144" must not be negative
