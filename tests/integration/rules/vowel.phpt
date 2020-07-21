--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\VowelException;
use Respect\Validation\Validator as v;

try {
    v::vowel()->check('b');
} catch (VowelException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::vowel('c')->check('d');
} catch (VowelException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::vowel())->check('a');
} catch (VowelException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::vowel('f'))->check('e');
} catch (VowelException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::vowel()->assert('g');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::vowel('h')->assert('j');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::vowel())->assert('i');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::vowel('k'))->assert('o');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
"b" must contain only vowels
"d" must contain only vowels and "c"
"a" must not contain vowels
"e" must not contain vowels or "f"
- "g" must contain only vowels
- "j" must contain only vowels and "h"
- "i" must not contain vowels
- "o" must not contain vowels or "k"
