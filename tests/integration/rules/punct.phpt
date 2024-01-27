--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::punct()->check('a'));
exceptionMessage(static fn() => v::punct('c')->check('b'));
exceptionMessage(static fn() => v::not(v::punct())->check('.'));
exceptionMessage(static fn() => v::not(v::punct('d'))->check('?'));
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
