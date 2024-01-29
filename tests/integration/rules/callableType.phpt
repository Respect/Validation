--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::callableType()->check([]));
exceptionMessage(static fn() => v::not(v::callableType())->check('trim'));
exceptionFullMessage(static fn() => v::callableType()->assert(true));
try {
    v::not(v::callableType())->assert(static function (): void {
    });
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
`[]` must be callable
`trim(string $string, string $characters = " \n\r\t\u000b\u0000"): string` must not be callable
- `true` must be callable
- `function (): void` must not be callable
