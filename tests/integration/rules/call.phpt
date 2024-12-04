--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::call('trim', v::noWhitespace())->assert(' two words '));
exceptionMessage(static fn() => v::not(v::call('stripslashes', v::stringType()))->assert(' some\\thing '));
exceptionMessage(static fn() => v::call('stripslashes', v::alwaysValid())->assert([]));
exceptionFullMessage(static fn() => v::call('strval', v::intType())->assert(1234));
exceptionFullMessage(static fn() => v::not(v::call('is_float', v::boolType()))->assert(1.2));
exceptionFullMessage(static fn() => v::call('array_shift', v::alwaysValid())->assert(INF));
?>
--EXPECT--
"two words" must not contain whitespaces
" something " must not be a string
`[]` must be a suitable argument for `stripslashes(string $string): string`
- "1234" must be an integer
- `true` must not be a boolean
- `INF` must be a suitable argument for `array_shift(array &$array): ?mixed`