--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::uppercase()->assert('lowercase'));
exceptionFullMessage(static fn() => v::uppercase()->assert('lowercase'));
exceptionMessage(static fn() => v::not(v::uppercase())->assert('UPPERCASE'));
exceptionFullMessage(static fn() => v::not(v::uppercase())->assert('UPPERCASE'));
?>
--EXPECT--
"lowercase" must be uppercase
- "lowercase" must be uppercase
"UPPERCASE" must not be uppercase
- "UPPERCASE" must not be uppercase
