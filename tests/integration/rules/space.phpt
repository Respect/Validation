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
    v::space()->check('ab');
} catch (SpaceException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::space('c')->check('cd');
} catch (SpaceException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::space())->check("\t");
} catch (SpaceException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::space('def'))->check("\r");
} catch (SpaceException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::space()->assert('ef');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::space('e')->assert('gh');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::space())->assert("\n");
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::space('yk'))->assert(' k');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"ab" must contain only space characters
"cd" must contain only space characters and "c"
"\t" must not contain space characters
"\r" must not contain space characters or "def"
- "ef" must contain only space characters
- "gh" must contain only space characters and "e"
- "\n" must not contain space characters
- " k" must not contain space characters or "yk"
