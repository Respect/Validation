--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::callableType()->assert([]));
exceptionMessage(static fn() => v::not(v::callableType())->assert('trim'));
exceptionFullMessage(static fn() => v::callableType()->assert(true));
exceptionFullMessage(static fn() => v::not(v::callableType())->assert(static function (): void {
    // Do nothing
}));
?>
--EXPECT--
`[]` must be a callable
`trim(string $string, string $characters = " \n\r\t\u000b\u0000"): string` must not be a callable
- `true` must be a callable
- `function (): void` must not be a callable