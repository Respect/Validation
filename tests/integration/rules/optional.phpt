--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::optional(v::alpha())->check(1234);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::optional(v::alpha())->setName('Name')->check(1234);
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::optional(v::alpha()))->check('abcd');
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::optional(v::alpha()))->setName('Name')->check('abcd');
} catch (ValidationException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::optional(v::alpha())->assert(1234);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::optional(v::alpha())->setName('Name')->assert(1234);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::optional(v::alpha()))->assert('abcd');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::optional(v::alpha()))->setName('Name')->assert('abcd');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
1234 must contain only letters (a-z)
Name must contain only letters (a-z)
The value must not be optional
Name must not be optional
- 1234 must contain only letters (a-z)
- Name must contain only letters (a-z)
- The value must not be optional
- Name must not be optional
