--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::consonant()->check('aeiou'));
exceptionMessage(static fn() => v::consonant('d')->check('daeiou'));
exceptionMessage(static fn() => v::not(v::consonant())->check('bcd'));
exceptionMessage(static fn() => v::not(v::consonant('a'))->check('abcd'));
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
