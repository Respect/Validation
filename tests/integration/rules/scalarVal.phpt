--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::scalarVal()->check([]));
exceptionMessage(static fn() => v::not(v::scalarVal())->check(true));
exceptionFullMessage(static fn() => v::scalarVal()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::scalarVal())->assert(42));
?>
--EXPECT--
`{ }` must be a scalar value
`TRUE` must not be a scalar value
- `[object] (stdClass: { })` must be a scalar value
- 42 must not be a scalar value
