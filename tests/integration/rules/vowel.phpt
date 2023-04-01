--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::vowel()->check('b'));
exceptionMessage(static fn() => v::vowel('c')->check('d'));
exceptionMessage(static fn() => v::not(v::vowel())->check('a'));
exceptionMessage(static fn() => v::not(v::vowel('f'))->check('e'));
exceptionFullMessage(static fn() => v::vowel()->assert('g'));
exceptionFullMessage(static fn() => v::vowel('h')->assert('j'));
exceptionFullMessage(static fn() => v::not(v::vowel())->assert('i'));
exceptionFullMessage(static fn() => v::not(v::vowel('k'))->assert('o'));
?>
--EXPECT--
"b" must contain only vowels
"d" must contain only vowels and "c"
"a" must not contain vowels
"e" must not contain vowels or "f"
- "g" must contain only vowels
- "j" must contain only vowels and "h"
- "i" must not contain vowels
- "o" must not contain vowels or "k"
