--CREDITS--
Paul Karikari <paulkarikari1@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::unique()->check([1, 2, 2, 3]));
exceptionMessage(static fn() => v::not(v::unique())->check([1, 2, 3, 4]));
exceptionFullMessage(static fn() => v::unique()->assert('test'));
exceptionFullMessage(static fn() => v::not(v::unique())->assert(['a', 'b', 'c']));
?>
--EXPECT--
`{ 1, 2, 2, 3 }` must not contain duplicates
`{ 1, 2, 3, 4 }` must contain duplicates
- "test" must not contain duplicates
- `{ "a", "b", "c" }` must contain duplicates
