--CREDITS--
Emmerson Siqueira <emmersonsiqueira@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::arrayVal()->check('Bla %123'));
exceptionMessage(static fn() => v::not(v::arrayVal())->check([42]));
exceptionFullMessage(static fn() => v::arrayVal()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::arrayVal())->assert(new ArrayObject([2, 3])));
?>
--EXPECT--
"Bla %123" must be an array value
`{ 42 }` must not be an array value
- `[object] (stdClass: { })` must be an array value
- `[traversable] (ArrayObject: { 2, 3 })` must not be an array value
