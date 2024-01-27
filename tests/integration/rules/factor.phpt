--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::factor(3)->check(2));
exceptionMessage(static fn() => v::not(v::factor(0))->check(300));
exceptionFullMessage(static fn() => v::factor(5)->assert(3));
exceptionFullMessage(static fn() => v::not(v::factor(6))->assert(1));
?>
--EXPECT--
2 must be a factor of 3
300 must not be a factor of 0
- 3 must be a factor of 5
- 1 must not be a factor of 6
