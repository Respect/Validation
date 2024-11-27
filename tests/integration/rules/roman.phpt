--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::roman()->assert(1234));
exceptionMessage(static fn() => v::not(v::roman())->assert('XL'));
exceptionFullMessage(static fn() => v::roman()->assert('e2'));
exceptionFullMessage(static fn() => v::not(v::roman())->assert('IV'));
?>
--EXPECT--
1234 must be a valid Roman numeral
"XL" must not be a valid Roman numeral
- "e2" must be a valid Roman numeral
- "IV" must not be a valid Roman numeral
