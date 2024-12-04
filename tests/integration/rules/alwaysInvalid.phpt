--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::alwaysInvalid()->assert('whatever'));
exceptionFullMessage(static fn() => v::alwaysInvalid()->assert(''));
?>
--EXPECT--
"whatever" must be valid
- "" must be valid