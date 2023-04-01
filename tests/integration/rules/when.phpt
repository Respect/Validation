--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::when(v::alwaysValid(), v::intVal())->check('abc'));
exceptionMessage(static fn() => v::when(v::alwaysInvalid(), v::alwaysValid(), v::intVal())->check('def'));
exceptionMessage(static fn() => v::not(v::when(v::alwaysValid(), v::stringVal()))->check('ghi'));
exceptionMessage(static fn() => v::not(v::when(v::alwaysInvalid(), v::alwaysValid(), v::stringVal()))->check('jkl'));
exceptionFullMessage(static fn() => v::when(v::alwaysValid(), v::intVal())->assert('mno'));
exceptionFullMessage(static fn() => v::when(v::alwaysInvalid(), v::alwaysValid(), v::intVal())->assert('pqr'));
exceptionFullMessage(static fn() => v::not(v::when(v::alwaysValid(), v::stringVal()))->assert('stu'));
exceptionFullMessage(static function () {
    v::not(v::when(v::alwaysInvalid(), v::alwaysValid(), v::stringVal()))->assert('vwx');
});
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
