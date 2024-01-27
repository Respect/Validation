--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::floatVal()->check('a'));
exceptionMessage(static fn() => v::not(v::floatVal())->check(165.0));
exceptionFullMessage(static fn() => v::floatVal()->assert('a'));
exceptionFullMessage(static fn() => v::not(v::floatVal())->assert('165.7'));
?>
--EXPECT--
"a" must be a float number
165.0 must not be a float number
- "a" must be a float number
- "165.7" must not be a float number
