--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::vowel()->assert('b'));
exceptionMessage(static fn() => v::vowel('c')->assert('d'));
exceptionMessage(static fn() => v::not(v::vowel())->assert('a'));
exceptionMessage(static fn() => v::not(v::vowel('f'))->assert('e'));
exceptionFullMessage(static fn() => v::vowel()->assert('g'));
exceptionFullMessage(static fn() => v::vowel('h')->assert('j'));
exceptionFullMessage(static fn() => v::not(v::vowel())->assert('i'));
exceptionFullMessage(static fn() => v::not(v::vowel('k'))->assert('o'));
?>
--EXPECT--
"b" must consist of vowels only
"d" must consist of vowels and "c"
"a" must not consist of vowels only
"e" must not consist of vowels or "f"
- "g" must consist of vowels only
- "j" must consist of vowels and "h"
- "i" must not consist of vowels only
- "o" must not consist of vowels or "k"