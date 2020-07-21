--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PunctException;
use Respect\Validation\Validator as v;

try {
    v::punct()->check('a');
} catch (PunctException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::punct('c')->check('b');
} catch (PunctException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::punct())->check('.');
} catch (PunctException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::punct('d'))->check('?');
} catch (PunctException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::punct()->assert('e');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::punct('f')->assert('g');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::punct())->assert('!');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::punct('h'))->assert(';');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"a" must contain only punctuation characters
"b" must contain only punctuation characters and "c"
"." must not contain punctuation characters
"?" must not contain punctuation characters or "d"
- "e" must contain only punctuation characters
- "g" must contain only punctuation characters and "f"
- "!" must not contain punctuation characters
- ";" must not contain punctuation characters or "h"
