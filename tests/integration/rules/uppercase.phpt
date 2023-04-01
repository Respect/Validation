--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::uppercase()->check('lowercase'));
exceptionFullMessage(static fn() => v::uppercase()->assert('lowercase'));
exceptionMessage(static fn() => v::not(v::uppercase())->check('UPPERCASE'));
exceptionFullMessage(static fn() => v::not(v::uppercase())->assert('UPPERCASE'));
?>
--EXPECT--
"lowercase" must be uppercase
- "lowercase" must be uppercase
"UPPERCASE" must not be uppercase
- "UPPERCASE" must not be uppercase
