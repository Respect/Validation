--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::numericVal()->assert('a'));
exceptionMessage(static fn() => v::not(v::numericVal())->assert('1'));
exceptionFullMessage(static fn() => v::numericVal()->assert('a'));
exceptionFullMessage(static fn() => v::not(v::numericVal())->assert('1'));
?>
--EXPECT--
"a" must be a numeric value
"1" must not be a numeric value
- "a" must be a numeric value
- "1" must not be a numeric value