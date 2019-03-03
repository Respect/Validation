--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\SpaceException;
use Respect\Validation\Validator as v;

try {
    v::space()->check('');
} catch (SpaceException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::space('c')->check('abc');
} catch (SpaceException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::space())->check('   ');
} catch (SpaceException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::space('abc'))->check('abc   a');
} catch (SpaceException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::space()->assert('');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::space('e')->assert('abcde');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::space())->assert('   ');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::space('yk'))->assert('yyy   k');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"" must contain only space characters
"abc" must contain only space characters and "c"
"   " must not contain space characters
"abc   a" must not contain space characters or "abc"
- "" must contain only space characters
- "abcde" must contain only space characters and "e"
- "   " must not contain space characters
- "yyy   k" must not contain space characters or "yk"
