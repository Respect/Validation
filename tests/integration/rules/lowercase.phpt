--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::lowercase()->assert('UPPERCASE'));
exceptionMessage(static fn() => v::not(v::lowercase())->assert('lowercase'));
exceptionFullMessage(static fn() => v::lowercase()->assert('UPPERCASE'));
exceptionFullMessage(static fn() => v::not(v::lowercase())->assert('lowercase'));
?>
--EXPECT--
"UPPERCASE" must be lowercase
"lowercase" must not be lowercase
- "UPPERCASE" must be lowercase
- "lowercase" must not be lowercase
