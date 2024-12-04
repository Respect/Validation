--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::uppercase()->assert('lowercase'));
exceptionFullMessage(static fn() => v::uppercase()->assert('lowercase'));
exceptionMessage(static fn() => v::not(v::uppercase())->assert('UPPERCASE'));
exceptionFullMessage(static fn() => v::not(v::uppercase())->assert('UPPERCASE'));
?>
--EXPECT--
"lowercase" must contain only uppercase letters
- "lowercase" must contain only uppercase letters
"UPPERCASE" must not contain only uppercase letters
- "UPPERCASE" must not contain only uppercase letters