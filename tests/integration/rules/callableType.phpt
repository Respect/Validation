--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CallableTypeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::callableType()->check([]);
} catch (CallableTypeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::callableType())->check('trim');
} catch (CallableTypeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::callableType()->assert(true);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::callableType())->assert(static function (): void {
    });
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
`{ }` must be callable
"trim" must not be callable
- `TRUE` must be callable
- `[object] (Closure: { })` must not be callable
