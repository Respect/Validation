--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::stringVal()->check([]));
exceptionMessage(static fn() => v::not(v::stringVal())->check(true));
exceptionFullMessage(static fn() => v::stringVal()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::stringVal())->assert(42));
?>
--EXPECT--
`{ }` must be a string
`TRUE` must not be string
- `[object] (stdClass: { })` must be a string
- 42 must not be string
