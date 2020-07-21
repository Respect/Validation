--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
Ian Nisbet <ian@glutenite.co.uk>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::keyValue('foo', 'equals', 'bar')->check(['bar' => 42]);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::keyValue('foo', 'equals', 'bar')->check(['foo' => 42]);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::keyValue('foo', 'json', 'bar')->check(['foo' => 42, 'bar' => 43]);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::keyValue('foo', 'equals', 'bar')->check(['foo' => 1, 'bar' => 2]);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::keyValue('foo', 'equals', 'bar'))->check(['foo' => 1, 'bar' => 1]);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::keyValue('foo', 'equals', 'bar')->assert(['bar' => 42]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::keyValue('foo', 'equals', 'bar')->assert(['foo' => 42]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::keyValue('foo', 'json', 'bar')->assert(['foo' => 42, 'bar' => 43]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::keyValue('foo', 'equals', 'bar')->assert(['foo' => 1, 'bar' => 2]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::keyValue('foo', 'equals', 'bar'))->assert(['foo' => 1, 'bar' => 1]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
Key "foo" must be present
Key "bar" must be present
"bar" must be valid to validate "foo"
foo must equal "bar"
foo must not equal "bar"
- Key "foo" must be present
- Key "bar" must be present
- "bar" must be valid to validate "foo"
- foo must equal "bar"
- foo must not equal "bar"
