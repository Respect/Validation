--CREDITS--
Danilo Correa<danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\StartsWithException;
use Respect\Validation\Validator as v;

try {
    v::startsWith('bar')->check(['foo', 'bar']);
} catch (StartsWithException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::startsWith('1.1', true)->check([1.1, 2.2]);
} catch (StartsWithException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::startsWith('foo'))->check('foobazfoo');
} catch (StartsWithException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::startsWith('1', true))->check(['1', 2, 3]);
} catch (StartsWithException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::startsWith('bar')->assert(['foo', 'bar']);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::startsWith('1.1', true)->assert([1.1, 2.2]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::startsWith('foo'))->assert('foobazfoo');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::startsWith('1', true))->assert(['1', 2, 3]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
`{ "foo", "bar" }` must start with ("bar")
`{ 1.1, 2.2 }` must start with ("1.1")
"foobazfoo" must not start with ("foo")
`{ "1", 2, 3 }` must not start with ("1")
- `{ "foo", "bar" }` must start with ("bar")
- `{ 1.1, 2.2 }` must start with ("1.1")
- "foobazfoo" must not start with ("foo")
- `{ "1", 2, 3 }` must not start with ("1")
