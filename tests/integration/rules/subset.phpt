--CREDITS--
Singwai Chan <singwai.chan@live.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::subset([1, 2])->check([1, 2, 3]));
exceptionMessage(static fn() => v::not(v::subset([1, 2, 3]))->check([1, 2]));
exceptionFullMessage(static fn() => v::subset(['A', 'B'])->assert(['B', 'C']));
exceptionFullMessage(static fn() => v::not(v::subset(['A']))->assert(['A']));
?>
--EXPECT--
`{ 1, 2, 3 }` must be subset of `{ 1, 2 }`
`{ 1, 2 }` must not be subset of `{ 1, 2, 3 }`
- `{ "B", "C" }` must be subset of `{ "A", "B" }`
- `{ "A" }` must not be subset of `{ "A" }`
