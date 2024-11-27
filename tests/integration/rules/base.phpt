--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::base(61)->assert('Z01xSsg5675hic20dj'));
exceptionFullMessage(static fn() => v::base(2)->assert(''));
exceptionMessage(static fn() => v::not(v::base(2))->assert('011010001'));
exceptionFullMessage(static fn() => v::not(v::base(2))->assert('011010001'));
?>
--EXPECT--
"Z01xSsg5675hic20dj" must be a number in the base 61
- "" must be a number in the base 2
"011010001" must not be a number in the base 2
- "011010001" must not be a number in the base 2
