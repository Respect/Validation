--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::stringType()->check(42));
exceptionMessage(static fn() => v::not(v::stringType())->check('foo'));
exceptionFullMessage(static fn() => v::stringType()->assert(true));
exceptionFullMessage(static fn() => v::not(v::stringType())->assert('bar'));
?>
--EXPECT--
42 must be of type string
"foo" must not be of type string
- `TRUE` must be of type string
- "bar" must not be of type string
