--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::instance(DateTime::class)->assert(''));
exceptionMessage(static fn() => v::not(v::instance(Traversable::class))->assert(new ArrayObject()));
exceptionFullMessage(static fn() => v::instance(ArrayIterator::class)->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::instance(stdClass::class))->assert(new stdClass()));
?>
--EXPECT--
"" must be an instance of `DateTime`
`ArrayObject { getArrayCopy() => [] }` must not be an instance of `Traversable`
- `stdClass {}` must be an instance of `ArrayIterator`
- `stdClass {}` must not be an instance of `stdClass`
