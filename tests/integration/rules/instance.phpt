--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::instance(DateTime::class)->check(''));
exceptionMessage(static fn() => v::not(v::instance(Traversable::class))->check(new ArrayObject()));
exceptionFullMessage(static fn() => v::instance(ArrayIterator::class)->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::instance(stdClass::class))->assert(new stdClass()));
?>
--EXPECT--
"" must be an instance of "DateTime"
`[traversable] (ArrayObject: { })` must not be an instance of "Traversable"
- `[object] (stdClass: { })` must be an instance of "ArrayIterator"
- `[object] (stdClass: { })` must not be an instance of "stdClass"
