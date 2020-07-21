--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\ControlException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::control()->check('16-50');
} catch (ControlException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::control('16')->check('16-50');
} catch (ControlException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::control())->check("\n");
} catch (ControlException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::control('16'))->check("16\n");
} catch (ControlException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::control()->assert('Foo');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::control('Bar')->assert('Foo');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::control())->assert("\n");
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::control('Bar'))->assert("Bar\n");
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
"16-50" must contain only control characters
"16-50" must contain only control characters and "16"
"\n" must not contain control characters
"16\n" must not contain control characters or "16"
- "Foo" must contain only control characters
- "Foo" must contain only control characters and "Bar"
- "\n" must not contain control characters
- "Bar\n" must not contain control characters or "Bar"
