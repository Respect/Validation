--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::noWhitespace()->check('w poiur'));
exceptionMessage(static fn() => v::not(v::noWhitespace())->check('wpoiur'));
exceptionFullMessage(static fn() => v::noWhitespace()->assert('w poiur'));
exceptionFullMessage(static fn() => v::not(v::noWhitespace())->assert('wpoiur'));
?>
--EXPECT--
"w poiur" must not contain whitespace
"wpoiur" must contain whitespace
- "w poiur" must not contain whitespace
- "wpoiur" must contain whitespace
