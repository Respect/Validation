--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::cnh()->assert('batman'));
exceptionMessage(static fn() => v::not(v::cnh())->assert('02650306461'));
exceptionFullMessage(static fn() => v::cnh()->assert('bruce wayne'));
exceptionFullMessage(static fn() => v::not(v::cnh())->assert('02650306461'));
?>
--EXPECT--
"batman" must be a valid CNH number
"02650306461" must not be a valid CNH number
- "bruce wayne" must be a valid CNH number
- "02650306461" must not be a valid CNH number
