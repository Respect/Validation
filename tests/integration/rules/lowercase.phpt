--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::lowercase()->check('UPPERCASE'));
exceptionMessage(static fn() => v::not(v::lowercase())->check('lowercase'));
exceptionFullMessage(static fn() => v::lowercase()->assert('UPPERCASE'));
exceptionFullMessage(static fn() => v::not(v::lowercase())->assert('lowercase'));
?>
--EXPECT--
"UPPERCASE" must be lowercase
"lowercase" must not be lowercase
- "UPPERCASE" must be lowercase
- "lowercase" must not be lowercase
