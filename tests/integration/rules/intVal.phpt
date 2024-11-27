--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::intVal()->assert('42.33'));
exceptionMessage(static fn() => v::not(v::intVal())->assert(2));
exceptionFullMessage(static fn() => v::intVal()->assert('Foo'));
exceptionFullMessage(static fn() => v::not(v::intVal())->assert(3));
exceptionFullMessage(static fn() => v::not(v::intVal())->assert(-42));
exceptionFullMessage(static fn() => v::not(v::intVal())->assert('-42'));
?>
--EXPECT--
"42.33" must be an integer number
2 must not be an integer number
- "Foo" must be an integer number
- 3 must not be an integer number
- -42 must not be an integer number
- "-42" must not be an integer number
