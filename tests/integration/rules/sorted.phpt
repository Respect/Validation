--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::sorted('ASC')->check([1, 3, 2]));
exceptionMessage(static fn() => v::sorted('DESC')->check([1, 2, 3]));
exceptionMessage(static fn() => v::not(v::sorted('ASC'))->check([1, 2, 3]));
exceptionMessage(static fn() => v::not(v::sorted('DESC'))->check([3, 2, 1]));
exceptionFullMessage(static fn() => v::sorted('ASC')->assert([3, 2, 1]));
exceptionFullMessage(static fn() => v::sorted('DESC')->assert([1, 2, 3]));
exceptionFullMessage(static fn() => v::not(v::sorted('ASC'))->assert([1, 2, 3]));
exceptionFullMessage(static fn() => v::not(v::sorted('DESC'))->assert([3, 2, 1]));
?>
--EXPECT--
`{ 1, 3, 2 }` must be sorted in ascending order
`{ 1, 2, 3 }` must be sorted in descending order
`{ 1, 2, 3 }` must not be sorted in ascending order
`{ 3, 2, 1 }` must not be sorted in descending order
- `{ 3, 2, 1 }` must be sorted in ascending order
- `{ 1, 2, 3 }` must be sorted in descending order
- `{ 1, 2, 3 }` must not be sorted in ascending order
- `{ 3, 2, 1 }` must not be sorted in descending order
