--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::notUndef()->check(null));
exceptionMessage(static fn() => v::not(v::notUndef())->check(0));
exceptionMessage(static fn() => v::notUndef()->setName('Field')->check(null));
exceptionMessage(static fn() => v::not(v::notUndef()->setName('Field'))->check([]));
exceptionFullMessage(static fn() => v::notUndef()->assert(''));
exceptionFullMessage(static fn() => v::not(v::notUndef())->assert([]));
exceptionFullMessage(static fn() => v::notUndef()->setName('Field')->assert(''));
exceptionFullMessage(static fn() => v::not(v::notUndef()->setName('Field'))->assert([]));
?>
--EXPECT--
The value must not be optional
The value must be optional
Field must not be optional
Field must be optional
- The value must not be optional
- The value must be optional
- Field must not be optional
- Field must be optional
