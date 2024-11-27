--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::noWhitespace()->assert('w poiur'));
exceptionMessage(static fn() => v::not(v::noWhitespace())->assert('wpoiur'));
exceptionFullMessage(static fn() => v::noWhitespace()->assert('w poiur'));
exceptionFullMessage(static fn() => v::not(v::noWhitespace())->assert('wpoiur'));
?>
--EXPECT--
"w poiur" must not contain whitespace
"wpoiur" must contain whitespace
- "w poiur" must not contain whitespace
- "wpoiur" must contain whitespace
