--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::punct()->assert('a'));
exceptionMessage(static fn() => v::punct('c')->assert('b'));
exceptionMessage(static fn() => v::not(v::punct())->assert('.'));
exceptionMessage(static fn() => v::not(v::punct('d'))->assert('?'));
exceptionFullMessage(static fn() => v::punct()->assert('e'));
exceptionFullMessage(static fn() => v::punct('f')->assert('g'));
exceptionFullMessage(static fn() => v::not(v::punct())->assert('!'));
exceptionFullMessage(static fn() => v::not(v::punct('h'))->assert(';'));
?>
--EXPECT--
"a" must contain only punctuation characters
"b" must contain only punctuation characters and "c"
"." must not contain punctuation characters
"?" must not contain punctuation characters or "d"
- "e" must contain only punctuation characters
- "g" must contain only punctuation characters and "f"
- "!" must not contain punctuation characters
- ";" must not contain punctuation characters or "h"
