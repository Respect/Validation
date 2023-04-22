--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::call('trim', v::noWhitespace())->check(' two words '));
exceptionMessage(static fn() => v::not(v::call('stripslashes', v::stringType()))->check(' something '));
exceptionMessage(static fn() => v::call('stripslashes', v::alwaysValid())->check([]));
exceptionFullMessage(static fn() => v::call('strval', v::intType())->assert(1234));
exceptionFullMessage(static fn() => v::not(v::call('is_float', v::boolType()))->assert(1.2));
exceptionFullMessage(static fn() => v::call('array_shift', v::alwaysValid())->assert(INF));
?>
--EXPECT--
"two words" must not contain whitespace
" something " must not be valid when executed with `stripslashes(string $string): string`
`[]` must be valid when executed with `stripslashes(string $string): string`
- "1234" must be of type integer
- 1.2 must not be valid when executed with `is_float(?mixed $value): bool`
- `INF` must be valid when executed with `array_shift(array &$array): ?mixed`
