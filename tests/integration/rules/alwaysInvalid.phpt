--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::alwaysInvalid()->assert('whatever'));
exceptionFullMessage(static fn() => v::alwaysInvalid()->assert(''));
?>
--EXPECT--
"whatever" is always invalid
- "" is always invalid
