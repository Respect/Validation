--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::consonant()->assert('aeiou'));
exceptionMessage(static fn() => v::consonant('d')->assert('daeiou'));
exceptionMessage(static fn() => v::not(v::consonant())->assert('bcd'));
exceptionMessage(static fn() => v::not(v::consonant('a'))->assert('abcd'));
exceptionFullMessage(static fn() => v::consonant()->assert('aeiou'));
exceptionFullMessage(static fn() => v::consonant('d')->assert('daeiou'));
exceptionFullMessage(static fn() => v::not(v::consonant())->assert('bcd'));
exceptionFullMessage(static fn() => v::not(v::consonant('a'))->assert('abcd'));
?>
--EXPECT--
"aeiou" must contain only consonants
"daeiou" must contain only consonants and "d"
"bcd" must not contain consonants
"abcd" must not contain consonants or "a"
- "aeiou" must contain only consonants
- "daeiou" must contain only consonants and "d"
- "bcd" must not contain consonants
- "abcd" must not contain consonants or "a"
