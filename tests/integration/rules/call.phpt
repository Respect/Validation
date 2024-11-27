--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::call('trim', v::noWhitespace())->check(' two words '));
exceptionMessage(static fn() => v::not(v::call('stripslashes', v::stringType()))->check(' some\\thing '));
exceptionMessage(static fn() => v::call('stripslashes', v::alwaysValid())->check([]));
exceptionFullMessage(static fn() => v::call('strval', v::intType())->assert(1234));
exceptionFullMessage(static fn() => v::not(v::call('is_float', v::boolType()))->assert(1.2));
exceptionFullMessage(static fn() => v::call('array_shift', v::alwaysValid())->assert(INF));
?>
--EXPECT--
"two words" must not contain whitespace
" something " must not be of type string
`[]` must be valid when executed with `stripslashes(string $string): string`
- "1234" must be of type integer
- `true` must not be of type boolean
- `INF` must be valid when executed with `array_shift(array &$array): ?mixed`
