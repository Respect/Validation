--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::odd()->check(2));
exceptionMessage(static fn() => v::not(v::odd())->check(7));
exceptionFullMessage(static fn() => v::odd()->assert(2));
exceptionFullMessage(static fn() => v::not(v::odd())->assert(9));
?>
--EXPECT--
2 must be an odd number
7 must not be an odd number
- 2 must be an odd number
- 9 must not be an odd number
