--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IntValException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\WhenException;
use Respect\Validation\Validator as v;

try {
    v::when(v::alwaysValid(), v::intVal())->check('abc');
} catch (IntValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::when(v::alwaysInvalid(), v::alwaysValid(), v::intVal())->check('def');
} catch (IntValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::when(v::alwaysValid(), v::stringVal()))->check('ghi');
} catch (WhenException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::when(v::alwaysInvalid(), v::alwaysValid(), v::stringVal()))->check('jkl');
} catch (WhenException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::when(v::alwaysValid(), v::intVal())->assert('mno');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::when(v::alwaysInvalid(), v::alwaysValid(), v::intVal())->assert('pqr');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::when(v::alwaysValid(), v::stringVal()))->assert('stu');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::when(v::alwaysInvalid(), v::alwaysValid(), v::stringVal()))->assert('vwx');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"abc" must be an integer number
"def" must be an integer number
"ghi" must not be valid
"jkl" must not be valid
- "mno" must be an integer number
- "pqr" must be an integer number
- "stu" must not be valid
- "vwx" must not be valid
