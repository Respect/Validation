--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::multiple(3)->check(22));
exceptionMessage(static fn() => v::not(v::multiple(3))->check(9));
exceptionFullMessage(static fn() => v::multiple(2)->assert(5));
exceptionFullMessage(static fn() => v::not(v::multiple(5))->assert(25));
?>
--EXPECT--
22 must be multiple of 3
9 must not be multiple of 3
- 5 must be multiple of 2
- 25 must not be multiple of 5
