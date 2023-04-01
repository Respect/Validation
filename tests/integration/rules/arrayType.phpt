--CREDITS--
Emmerson Siqueira <emmersonsiqueira@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::arrayType()->check('teste'));
exceptionMessage(static fn() => v::not(v::arrayType())->check([]));
exceptionFullMessage(static fn() => v::arrayType()->assert(new ArrayObject()));
exceptionFullMessage(static fn() => v::not(v::arrayType())->assert([1, 2, 3]));
?>
--EXPECT--
"teste" must be of type array
`{ }` must not be of type array
- `[traversable] (ArrayObject: { })` must be of type array
- `{ 1, 2, 3 }` must not be of type array
