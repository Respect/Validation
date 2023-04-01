--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::notOptional()->check(null));
exceptionMessage(static fn() => v::not(v::notOptional())->check(0));
exceptionMessage(static fn() => v::notOptional()->setName('Field')->check(null));
exceptionMessage(static fn() => v::not(v::notOptional()->setName('Field'))->check([]));
exceptionFullMessage(static fn() => v::notOptional()->assert(''));
exceptionFullMessage(static fn() => v::not(v::notOptional())->assert([]));
exceptionFullMessage(static fn() => v::notOptional()->setName('Field')->assert(''));
exceptionFullMessage(static fn() => v::not(v::notOptional()->setName('Field'))->assert([]));
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
