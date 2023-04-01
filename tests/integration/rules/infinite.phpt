--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::infinite()->check(-9));
exceptionMessage(static fn() => v::not(v::infinite())->check(INF));
exceptionFullMessage(static fn() => v::infinite()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::infinite())->assert(INF * -1));
?>
--EXPECT--
-9 must be an infinite number
`INF` must not be an infinite number
- `[object] (stdClass: { })` must be an infinite number
- `-INF` must not be an infinite number
