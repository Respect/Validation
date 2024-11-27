--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::directory()->assert('batman'));
exceptionMessage(static fn() => v::not(v::directory())->assert(dirname('/etc/')));
exceptionFullMessage(static fn() => v::directory()->assert('ppz'));
exceptionFullMessage(static fn() => v::not(v::directory())->assert(dirname('/etc/')));
?>
--EXPECT--
"batman" must be a directory
"/" must not be a directory
- "ppz" must be a directory
- "/" must not be a directory
