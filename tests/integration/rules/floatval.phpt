--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::floatVal()->assert('a'));
exceptionMessage(static fn() => v::not(v::floatVal())->assert(165.0));
exceptionFullMessage(static fn() => v::floatVal()->assert('a'));
exceptionFullMessage(static fn() => v::not(v::floatVal())->assert('165.7'));
?>
--EXPECT--
"a" must be a float number
165.0 must not be a float number
- "a" must be a float number
- "165.7" must not be a float number
